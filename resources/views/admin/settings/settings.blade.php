@extends('components.admin.layouts.adminapp')
@section('headSection')
@endsection
@section('main-content')
<x-admin.layouts.adminindexnav can="ttest" name=setting title="SETTINGS" button='disable' gate='true' />
<main class="w-full flex-grow p-3">

   <div class="p-2 mt-4 lg:mt-0 rounded shadow bg-white">
      <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3 m-5">
         <!-- Card -->
         <div class="flex items-center bg-blue-100 px-5 py-2 rounded-lg shadow-xs dark:bg-gray-800">
             <div class="pb-2 flex-shrink md:flex-shrink-0 ">
                <p class="mb-2 text-2xl font-medium  text-gray-800 dark:text-gray-400">
                {{ __('label.settings_title')}}
                </p>
                 <p class="p-2 text-sm font-semibold text-gray-700 dark:text-gray-200">
                 <a href="{{ URL('admin/addemployee') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-3 py-2 m-1 rounded">
                 {{ __('label.adduser_title')}}
                   </a>
                   @can('changepassword')
                   <a href="{{ URL('admin/changepasswordform') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-3  py-2 m-1 rounded">
                   {{ __('label.settings_changepassword')}}
                   </a>
                   @endcan
                </p>
             </div>
          </div>
         <!-- Card -->
         <div class="flex items-center bg-blue-100 px-5 py-3 rounded-lg shadow-xs dark:bg-gray-800">
            <div class="pb-2">
               <p class="mb-2 text-2xl font-medium  text-gray-800 dark:text-gray-400">
               {{ __('label.adminconfig_title')}}
               </p>
               <p class="p-2 text-sm font-semibold text-gray-700 dark:text-gray-200">
               @can('settingsconfiguration')
                  <a href="{{ URL('admin/configuration') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-3 py-2 m-1 rounded">
                  {{ __('label.config_title')}}
                  </a>
                  <a href="{{ URL('admin/2fa') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-3 py-2 m-1 rounded">
                  {{ __('label.twofa_title')}}
                  </a>
               @endcan
               </p>
            </div>
         </div>
         <!-- Card -->
         <div class="flex items-center bg-blue-100 px-5 py-3 rounded-lg shadow-xs dark:bg-gray-800">
            <div class="pb-2">
               <p class="mb-2 text-2xl font-medium  text-gray-800 dark:text-gray-400">
               {{ __('label.clearcache_title')}}
               </p>
               <p class="p-2 text-sm font-semibold text-gray-700 dark:text-gray-200">
               @can('settingsclearcache')
                  <a href="{{ URL('admin/cacheclear') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-3 py-2 m-1 rounded">
               {{ __('label.clearcache_title')}}
                  </a>
                  @endcan
               </p>
            </div>
         </div>
         <!-- Card -->
         <div class="flex items-center bg-blue-100 px-5 py-3 rounded-lg shadow-xs dark:bg-gray-800">
            <div class="pb-2">
               <p class="mb-2 text-2xl font-medium  text-gray-800 dark:text-gray-400">
               {{ __('label.systeminfo_title')}}
               </p>
               <p class="p-2 text-sm font-semibold text-gray-700 dark:text-gray-200">
               @can('settingssysteminfo')
                  <a href="{{ URL('admin/systeminfo') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-3 py-2 m-1 rounded">
                  {{ __('label.systeminfo_title')}}
                  </a>
               @endcan
                @can('settingsbackup')
                  <a href="{{ URL('admin/backuprun') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-3 py-2 m-1 rounded">
                  {{ __('label.databackup_title')}}
                  </a>
                  @endcan
               </p>
            </div>
         </div>

         <!-- Card -->
         <div class="flex items-center bg-blue-100 px-5 py-3 rounded-lg shadow-xs dark:bg-gray-800">
            <div class="pb-2">
               <p class="mb-2 text-2xl font-medium  text-gray-800 dark:text-gray-400">
               {{ __('label.rolesandpermission_title')}}
               </p>
               <p class="p-2 text-sm font-semibold text-gray-700 dark:text-gray-200">
                @can('setingsrolesandpremission')
                  <a href="{{ URL('admin/role') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold px-3 py-2 m-1 rounded">
                  {{ __('label.rolesandpermission_title')}}
                  </a>
                  @endcan
               </p>
            </div>
         </div>


      </div>
   </div>
</main>
@endsection
@section('footerSection')
@endsection
