<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage; 

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'profile_picture' => ['required'],
            'cover_photo' => ['required'],
        ]);

        if($request->hasFile('profile_picture')) {
            $pp_path = Storage::putFile('users', $request->file('profile_picture')); 
        }
        if($request->hasFile('cover_photo')) {
            $cp_path = Storage::putFile('users', $request->file('cover_photo')); 
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'profile_picture' => $pp_path, 
            'cover_photo' => $cp_path, 
            'role_id' => $request->input('role_id'), 
            'bio' => $request->bio, 
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
