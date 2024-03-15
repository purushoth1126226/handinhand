<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <x-admin.layouts.adminheader />
      <x-admin.layouts.adminheaderlibrary />
      @livewireStyles
   </head>
   <body>
      @include('sweetalert::alert')
      <div
         class="relative flex h-screen bg-blue-50"
         x-data="setup()"
         x-init="$refs.loadingScreen.classList.add('hidden')"
         >
         <!-- Loading Screen -->
         <div
            x-ref="loadingScreen"
            class="fixed inset-0 z-50 flex items-center justify-center bg-blue-600 bg-opacity-20"
            style="backdrop-filter: blur(14px)"
            >
            <span class="text-2xl">Loading...</span>
         </div>
         <x-admin.layouts.adminsidenav />
         <div class="relative flex flex-col flex-1 h-full max-h-full overflow-y-scroll">
            <!-- Desktop Header -->
            <x-admin.layouts.adminnavbar />
            <div class="flex flex-col flex-1 max-h-full pl-2 pr-2 rounded-md xl:pr-4">
               <!-- Main Content -->
               <main class="flex-1 pt-2">
                  <!-- Placeholder Cards -->
                  {{-- <div class="p-2 text-white bg-blue-500 rounded-md shadow-md">
                     <div class="flex items-center">
                        <span class="text-xl font-semibold tracking-wider uppercase">Dashboard</span>
                     </div>
                  </div> --}}

                  {{-- @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif --}}


                  @section('main-content')
                  @show 
               </main>
            </div>
            <!-- Admin Right SideNav -->
            <x-admin.layouts.adminrightsidenav />
            <x-admin.layouts.adminfooter />
         </div>
      </div>
      <x-admin.layouts.adminfooterlibrary />
      @livewireScripts
   </body>
</html>