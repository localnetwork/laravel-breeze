{{-- <div class="min-h-screen bg-gray-100"> --}}
    {{-- @if(request()->is('dashboard')) --}}
        {{-- @include('layouts.navigation') --}}
    {{-- @endif --}}

    {{-- @unless(request()->is('dashboard')) --}}
        @include('layouts.partials.header')
    {{-- @endunless --}}
    
    

    <main id="main">
        {{ $slot }} 
    </main>

        
    {{-- @if(request()->is('dashboard')) --}}
        @include('layouts.partials.footer')
    {{-- @endif --}}
{{-- </div> --}}
