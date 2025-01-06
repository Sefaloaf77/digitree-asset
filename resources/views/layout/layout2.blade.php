<!DOCTYPE html>
<html lang="en">

    @include('partials.head')
    
    
    <body x-data="main" class="font-inter text-base antialiased font-medium relative vertical" :class="[ $store.app.sidebar ? 'toggle-sidebar' : '', $store.app.fullscreen ? 'full' : '',$store.app.mode]">

        @yield('content')


        <!-- All javascirpt -->
        @include('partials.scripts')

    </body>        
</html>
