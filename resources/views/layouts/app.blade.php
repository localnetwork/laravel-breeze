{{-- <div class="min-h-screen bg-gray-100"> --}}
    @unless(request()->is('dashboard'))
        @include('layouts.partials.header')
    @endunless
    
    @if(request()->is('dashboard'))
        @include('layouts.navigation')
    @endif

        {{ $slot }} 

        
    @if(request()->is('dashboard'))
        @include('layouts.partials.footer')
    @endif
{{-- </div> --}}
