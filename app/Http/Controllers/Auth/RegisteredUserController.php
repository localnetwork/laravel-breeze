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
use ProtoneMedia\Splade\FileUploads\HandleSpladeFileUploads;  

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
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required'], 
            'profile_picture' => ['required'],
            'short_name' => ['required', 'unique:'.User::class], 
            'cover_photo' => ['required'],
            ],
            [
                'role_id.required' => 'Account Type is required.'
            ]
        );

        // if ($request->hasFile('proof')) {
        //     // $path = $request->file('proof')->store('public/point-transactions');
        //     $path = $request->file('proof')->store('public/point-transactions');
        // }

        if($request->hasFile('profile_picture')) {
            // $pp_path = Storage::putFile('images', $request->file('profile_picture')); 
            $pp_path = Storage::putFile('public', $request->file('profile_picture'));
            // $pp_path = $request->file('profile_picture')->store('public/profile_pictures');
        } 
        if($request->hasFile('cover_photo')) { 
            $cp_path = Storage::putFile('public', $request->file('cover_photo')); 
            // $cp_path = $request->file('cover_photo')->store('public/cover_photos');
        } 

        $user = User::create([
            'name' => $request->name,
            'short_name' => $request->short_name,
            'email' => $request->email,
            'profile_picture' => $pp_path, 
            'cover_photo' => $cp_path, 
            'role_id' => $request->role_id, 
            'bio' => $request->bio, 
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        Auth::login($user);
        return redirect(RouteServiceProvider::HOME);
    }
}
