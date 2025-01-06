<!DOCTYPE html>
<html lang="en">

    @include('partials.head')
    
    
    <body x-data="main" class="font-inter text-base antialiased font-medium relative vertical" :class="[ $store.app.sidebar ? 'toggle-sidebar' : '', $store.app.fullscreen ? 'full' : '',$store.app.mode]">

<!-- Start Layout -->
<div class="bg-white text-dark">

    <!-- Start Menu Sidebar Olverlay -->
    <div x-cloak class="fixed inset-0 bg-dark/90 backdrop-blur-sm z-40 lg:hidden" :class="{'hidden' : !$store.app.sidebar}" @click="$store.app.toggleSidebar()"></div>
    <!-- End Menu Sidebar Olverlay -->

    <!-- Start Main Content -->
    <div class="main-container flex mx-auto">
        <!-- Start Sidebar -->
        @include('partials.sidebar')
        <!-- End sidebar -->

        <!-- Start Content Area -->
        <div class="main-content flex-1">
            <!-- Start Topbar -->
            @include('partials.topbar')
            <!-- End Topbar -->

            <!-- Start Content -->
            <div class="h-[calc(100vh-60px)] relative overflow-y-auto overflow-x-hidden p-5 sm:p-7 space-y-5">

               <!-- Main Contenet -->
                @yield('content')
        
                <!-- start loader -->

                <!-- Start Footer -->
                @include('partials.footer')
                <!-- End Footer -->

            </div>
            <!-- End Content -->
        </div>
        <!-- End Content Area -->
    </div>
</div>
<!-- End Layout -->

<!-- All javascirpt -->
@include('partials.scripts')

</body>        
        
</html>
