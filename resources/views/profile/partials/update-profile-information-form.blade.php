<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    @php
        use ProtoneMedia\Splade\FileUploads\ExistingFile;    
        if($user->cover_photo){
            $cover_photo = ExistingFile::fromDisk('public')->get(basename($user->cover_photo))->previewUrl; 
        }else {
            $cover_photo = null; 
        }
        if($user->profile_picture){
            $profile_picture = ExistingFile::fromDisk('public')->get(basename($user->profile_picture))->previewUrl; 
        }else {
            $profile_picture = null; 
        }
    @endphp

    <x-splade-form method="patch" :default="['name' => $user->name, 'email' => $user->email, 'bio' => $user->bio, 'cover_photo' => $cover_photo]" :action="route('profile.update')"  class="mt-6 space-y-6" preserve-scroll>

        <x-splade-input id="name" name="name" type="text" :label="__('Name')" required autofocus autocomplete="name" />
        <x-splade-input id="email" name="email" type="email" :label="__('Email')" required autocomplete="email" />
        <x-splade-input id="bio" name="bio" type="text" :label="__('Bioo')" required autocomplete="bio" />
        {{-- <x-splade-wysiwyg class="hide-editor-toolbar" id="bio" name="bio" :label="__('Bio')" jodit="{ showXPathInStatusbar: false }" /> --}}
        <x-splade-file  label="Profile Picture" filepond="{ allowDrop: true }" dusk="profile_picture" name="profile_picture" @input="form.profile_picture = $event.target.files[0]" />
        <x-splade-file label="Cover Photo"  filepond="{ allowDrop: true }" dusk="cover_photo" name="cover_photo" @input="form.cover_photo = $event.target.files[0]" />

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800">
                    {{ __('Your email address is unverified.') }}

                    <Link method="post" href="{{ route('verification.send') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Click here to re-send the verification email.') }}
                    </Link>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif

        <div class="flex items-center gap-4">
            <x-splade-submit class="bg-[#00b14f] min-w-[100px] text-white" :label="__('Save')" />

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-gray-600">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </x-splade-form>
</section>
