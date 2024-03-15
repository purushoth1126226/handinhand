      <!-- Sidebar -->
      <aside
        class="fixed left-0 right-0 z-10 flex-col flex-shrink-0 h-full overflow-hidden transition-all bg-transparent bottom-10 xl:h-screen top-16 xl:static xl:z-auto"
        :class="{'flex xl:w-64': isSidebarOpen, 'hidden xl:flex xl:w-16': !isSidebarOpen}"
      >




        <!-- Sidebar header -->
        <div
          class="flex-shrink-0 hidden px-2 max-h-14 xl:items-center xl:justify-start xl:space-x-3 xl:flex xl:max-h-14 xl:h-full xl:px-4"
        >
          <!-- Sidebar Button -->
          <button @click="toggleSidebar" class="p-2 text-blue-600 rounded-full hover:bg-blue-200">
            <svg
              class="w-6 h-6"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
          <!-- Logo -->
          <a
            href="#"
            :class="{'xl:hidden': !isSidebarOpen}"
            class="flex-shrink-0 text-2xl font-bold tracking-widest text-yellow-500 uppercase"
          >
          CLINIC
          </a>
        </div>
        <!-- Sidebar Content -->








        <div
          class="fixed left-0 flex flex-col flex-1 max-h-screen px-2 overflow-hidden right-3 top-16 bottom-10 xl:static xl:pt-2 xl:pl-4 xl:mb-4"
        >
          <div
            :class="{'min-w-full xl:w-14': isSidebarOpen}"
            class="flex-1 max-h-full p-2 overflow-y-auto bg-white rounded-md shadow-2xl lg:shadow-md"
          >


            <!-- Sidebar links -->
          <nav aria-label="Main" class="flex-1 space-y-2 overflow-y-hidden hover:overflow-y-auto">
              <!-- Dashboards links -->
              <div x-data="{ isActive: false, open: false}">
                <!-- active & hover classes 'bg-blue-100 dark:bg-blue-600' -->
                @can('dashboard')
                <a
                  href="{{ route('admindashboard') }}"
                  class="flex items-center space-x-2 transition-colors sidenavbar admindashboardactive hover:bg-blue-500 hover:text-white  py-2  rounded"
                >
                  <span aria-hidden="true">
                    <svg
                      class="w-5 h-5"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                      />
                    </svg>
                  </span>
                  <span class="ml-2 text-sm"> {{ __('label.sidenav_dashboard') }}</span>
                </a>
                @endcan
              </div>

              <!-- Components links -->
              <div x-data="{ isActive: false, open: false }" class="space-y-0.5">
                <!-- active classes 'bg-blue-100 dark:bg-blue-600' -->
               @can('master')
                <a
                  href="#"
                  @click="$event.preventDefault(); open = !open"
                  class="flex items-center py-2  transition-colors rounded-md dark:text-light hover:bg-blue-500 hover:text-white sidenavbar categoryactive maincategoryactive subcategoryactive tagactive brandactive childcategoryactive"
                  :class="{ 'bg-blue-100 dark:bg-blue-600': isActive || open }"
                  role="button"
                  aria-haspopup="true"
                  :aria-expanded="(open || isActive) ? 'true' : 'false'"
                >
                  <span aria-hidden="true">
                     <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 11H5M19 11C20.1046 11 21 11.8954 21 13V19C21 20.1046 20.1046 21 19 21H5C3.89543 21 3 20.1046 3 19V13C3 11.8954 3.89543 11 5 11M19 11V9C19 7.89543 18.1046 7 17 7M5 11V9C5 7.89543 5.89543 7 7 7M7 7V5C7 3.89543 7.89543 3 9 3H15C16.1046 3 17 3.89543 17 5V7M7 7H17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                     </svg>
                  </span>
                  <span class="ml-2 text-sm"> {{ __('label.sidenav_master') }} </span>
                  <span aria-hidden="true" class="ml-auto">
                    <!-- active class 'rotate-180' -->
                    <svg
                      class="w-4 h-4 transition-transform transform"
                      :class="{ 'rotate-180': open }"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </span>
                </a>
                @endcan
                <div x-show="open" class="space-y-1 bg-gray-100" role="menu" arial-label="Categorys">
                  <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                  <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->

                  @can('allergy-list')
                  <a
                href="{{ route('allergy.index') }}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white sidenavbar maincategoryactive rounded"
                  >
                  {{ __('label.sidenav_allergy') }}
                  </a>
                  @endcan
                  @can('diagnosis-list')
                  <a
                    href="{{ route('diagnosis.index') }}"
                    role="menuitem"
                    class="m-1  p-1 block text-sm  hover:bg-blue-500 hover:text-white sidenavbar subcategoryactive rounded"
                  >
                  {{ __('label.sidenav_diagnosis') }}
                  </a>
                  @endcan
                  @can('labinvestigation-list')
                  <a
                    href="{{ route('labinvestigation.index') }}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white rounded sidenavbar childcategoryactive"
                  >
                  {{ __('label.sidenav_laboratory') }}
                  </a>
                  @endcan
                  @can('drug-list')
                  <a
                    href="{{ route('drug.index') }}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white rounded sidenavbar tagactive"
                  >
                  {{ __('label.sidenav_drug') }}
                  </a>
                  @endcan
                  @can('physicalandgeneralexam-list')
                  <a
                    href="{{route('physicalandgeneralexamination.index')}}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white rounded sidenavbar brandactive"
                  >
                  {{ __('label.sidenav_physicalandgeneralexamination') }}
                  </a>
                  @endcan
                  @can('village-list')
                  <a
                    href="{{route('village.index')}}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white rounded sidenavbar brandactive"
                  > Location
                  {{-- {{ __('label.sidenav_village') }} --}}
                  </a>
                  @endcan
                  @can('illness-list')
                  <a
                    href="{{route('illness.index')}}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white rounded sidenavbar brandactive"
                  >
                  {{ __('label.sidenav_illness') }}
                  </a>
                  @endcan
                </div>
              </div>











                         <!-- Pages links -->
             <div x-data="{ isActive: true, open: false }" class="space-y-0.5">
                <!-- active classes 'bg-blue-100 dark:bg-blue-600' -->
                @can('druginward')
                <a
                  href="#"
                  @click="$event.preventDefault(); open = !open"
                  class="flex items-center py-2 transition-colors rounded-md sidenavbar hover:bg-blue-500 hover:text-white"
                  role="button"
                  aria-haspopup="true"
                  :aria-expanded="(open || isActive) ? 'true' : 'false'"
                >
                  <span aria-hidden="true">
                  <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                  </svg>

                  </span>
                  <span class="ml-2 text-sm"> {{ __('label.sidenav_druginward') }} </span>
                  <span aria-hidden="true" class="ml-auto">
                    <!-- active class 'rotate-180' -->
                    <svg
                      class="w-4 h-4 transition-transform transform"
                      :class="{ 'rotate-180': open }"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </span>
                </a>
              @endcan
                <div x-show="open" class="space-y-1 bg-gray-100" role="menu" arial-label="Categorys">
                  <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                  <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                  @can('supplier-list')
                  <a
                href="{{ route('supplier.index') }}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white sidenavbar maincategoryactive rounded"
                  >
                  {{ __('label.sidenav_supplier') }}
                  </a>
                  @endcan
              </div>
              <div x-show="open" class="space-y-1 bg-gray-100" role="menu" arial-label="Categorys">
                  <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                  <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                  @can('inward-list')
                  <a
                href="{{ route('inward.create') }}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white sidenavbar maincategoryactive rounded"
                  >
                  {{ __('label.sidenav_inward') }}
                  </a>
                  @endcan
              </div>
              <div x-show="open" class="space-y-1 bg-gray-100" role="menu" arial-label="Categorys">
                  <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                  <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                  @can('pharmacystock-list')
                  <a
                href="{{ route('pharmacystock') }}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white sidenavbar maincategoryactive rounded"
                  >
                  {{ __('label.sidenav_pharmacystock') }}
                  </a>
                  @endcan
              </div>


              <!-- Pages links -->
              <div x-data="{ isActive: true, open: false }" class="space-y-0.5">
                <!-- active classes 'bg-blue-100 dark:bg-blue-600' -->
                @can('reception')
                <a
                  href="#"
                  @click="$event.preventDefault(); open = !open"
                  class="flex items-center py-2 transition-colors rounded-md sidenavbar productactive hover:bg-blue-500 hover:text-white"
                  role="button"
                  aria-haspopup="true"
                  :aria-expanded="(open || isActive) ? 'true' : 'false'"
                >
                  <span aria-hidden="true">
                  <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                  </svg>

                  </span>
                  <span class="ml-2 text-sm">{{ __('label.sidenav_reception') }} </span>
                  <span aria-hidden="true" class="ml-auto">
                    <!-- active class 'rotate-180' -->
                    <svg
                      class="w-4 h-4 transition-transform transform"
                      :class="{ 'rotate-180': open }"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </span>
                </a>
                @endcan
                <div x-show="open" class="space-y-1 bg-gray-100" role="menu" arial-label="Categorys">
                  <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                  <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                  @can('patientenrollment-list')
                  <a
                href="{{ route('enrollment.create') }}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white sidenavbar maincategoryactive rounded"
                  >
                  {{ __('label.sidenav_reception_patientenrollment') }}
                  </a>
                  @endcan
                  @can('patientenrollmenthistory-list')
                  <a
                href="{{route('enrollmenthistory.index')}}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white sidenavbar maincategoryactive rounded"
                  >
                  {{ __('label.sidenav_reception_patientenrollmenthistory') }}
                  </a>
                  @endcan
                  @can('patientenrollmentvitalshistory-list')
                  <a
                href="{{route('vital.index')}}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white sidenavbar maincategoryactive rounded"
                  >
                  {{ __('label.sidenav_reception_patientvitalshistory') }}
                  </a>
                  @endcan
              </div>

              <div x-data="{ isActive: true, open: false }" class="space-y-0.5">
                <!-- active classes 'bg-blue-100 dark:bg-blue-600' -->
                @can('doctors')
                <a
                  href="#"
                  @click="$event.preventDefault(); open = !open"
                  class="flex items-center py-2 transition-colors rounded-md  hover:bg-blue-500 hover:text-white enquiryactive complaintactive"
                  role="button"
                  aria-haspopup="true"
                  :aria-expanded="(open || isActive) ? 'true' : 'false'"
                >
                  <span aria-hidden="true">
                   {{-- <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg> --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                  </span>
                  <span class="ml-2 text-sm">{{ __('label.sidenav_doctors') }} </span>
                  <span aria-hidden="true" class="ml-auto">
                    <!-- active class 'rotate-180' -->
                    <svg
                      class="w-4 h-4 transition-transform transform"
                      :class="{ 'rotate-180': open }"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </span>
                </a>
                @endcan
                <div x-show="open" class="space-y-1 bg-gray-100" role="menu" arial-label="Product">
                  <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                  <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                  @can('patientdoctor-list')
                  <a
                    href="{{route('patientlist.index')}}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white rounded enquiryactive"
                  >
                  {{ __('label.sidenav_doctors_patients') }}
                  </a>
                  @endcan
                  @can('patientdoctorhistory-list')
                  <a
                    href="{{route('patienthistory.index')}}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white rounded complaintactive "
                  >
                  {{ __('label.sidenav_doctors_patientshistory') }}
                  </a>
                  @endcan
                </div>
              </div>
              <div x-data="{ isActive: true, open: false }" class="space-y-0.5">
                <!-- active classes 'bg-blue-100 dark:bg-blue-600' -->
                @can('laboratory')
                <a
                  href="#"
                  @click="$event.preventDefault(); open = !open"
                  class="flex items-center py-2 transition-colors rounded-md  hover:bg-blue-500 hover:text-white enquiryactive complaintactive"
                  role="button"
                  aria-haspopup="true"
                  :aria-expanded="(open || isActive) ? 'true' : 'false'"
                >
                  <span aria-hidden="true">
                  {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg> --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                </svg>
                  </span>
                  <span class="ml-2 text-sm"> {{ __('label.sidenav_laboratory') }}</span>
                  <span aria-hidden="true" class="ml-auto">
                    <!-- active class 'rotate-180' -->
                    <svg
                      class="w-4 h-4 transition-transform transform"
                      :class="{ 'rotate-180': open }"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </span>
                </a>
                @endcan
                <div x-show="open" class="space-y-1 bg-gray-100" role="menu" arial-label="Product">
                  <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                  <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                  @can('patientlab-list')
                  <a
                    href="{{route('labpatientlist.index')}}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white rounded enquiryactive"
                  >
                  {{ __('label.sidenav_laboratory_patients') }}
                  </a>
                  @endcan
                  @can('patientlabhistory-list')
                  <a
                    href="{{route('labpatienthistory.index')}}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white rounded complaintactive "
                  >
                  {{ __('label.sidenav_laboratory_patientshistory') }}
                  </a>
                  @endcan
                </div>
              </div>

              <div x-data="{ isActive: true, open: false }" class="space-y-0.5">
                <!-- active classes 'bg-blue-100 dark:bg-blue-600' -->
                @can('patientpharmacy-list')
                <a
                  href="#"
                  @click="$event.preventDefault(); open = !open"
                  class="flex items-center py-2 transition-colors rounded-md  hover:bg-blue-500 hover:text-white enquiryactive complaintactive"
                  role="button"
                  aria-haspopup="true"
                  :aria-expanded="(open || isActive) ? 'true' : 'false'"
                >
                  <span aria-hidden="true">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  </span>
                  <span class="ml-2 text-sm">{{__('label.sidenav_pharmacy')}}</span>
                  <span aria-hidden="true" class="ml-auto">
                    <!-- active class 'rotate-180' -->
                    <svg
                      class="w-4 h-4 transition-transform transform"
                      :class="{ 'rotate-180': open }"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </span>
                </a>
                @endcan
                <div x-show="open" class="space-y-1 bg-gray-100" role="menu" arial-label="Product">
                  <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                  <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                  @can('patientpharmacy-list')
                  <a
                    href="{{route('pharmacypatientlist.index')}}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white rounded enquiryactive"
                  >
                  {{__('label.sidenav_pharmacy_patients')}}
                  </a>
                  @endcan
                  @can('patientpharmacyhistory-list')
                  <a
                    href="{{route('pharmacypatienthistory.index')}}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white rounded complaintactive "
                  >
                  {{__('label.sidenav_pharmacy_patientshistory')}}
                  </a>
                  @endcan
                </div>
              </div>

              <div x-data="{ isActive: true, open: false }" class="space-y-0.5">
                <!-- active classes 'bg-blue-100 dark:bg-blue-600' -->
                @can('report')

                <a
                  href="#"
                  @click="$event.preventDefault(); open = !open"
                  class="flex items-center py-2 transition-colors rounded-md  hover:bg-blue-500 hover:text-white enquiryactive complaintactive"
                  role="button"
                  aria-haspopup="true"
                  :aria-expanded="(open || isActive) ? 'true' : 'false'"
                >
                  <span aria-hidden="true">
                   <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                  </svg>
                  </span>
                  <span class="ml-2 text-sm">  {{__('label.sidenav_report')}} </span>
                  <span aria-hidden="true" class="ml-auto">
                    <!-- active class 'rotate-180' -->
                    <svg
                      class="w-4 h-4 transition-transform transform"
                      :class="{ 'rotate-180': open }"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >


                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </span>
                </a>
                @endcan
                <div x-show="open" class="space-y-1 bg-gray-100" role="menu" arial-label="Product">
                  <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                  <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                  @can('patientenrollmentreport-list')
                  <a
                    href="{{route('enrollmentreport.index')}}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white rounded enquiryactive"
                  >
                  {{__('label.sidenav_report_patientsenrollment')}}
                  </a>
                  @endcan

                </div>
                <div x-show="open" class="space-y-1 bg-gray-100" role="menu" arial-label="Product">
                  <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                  <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                  @can('patientvitalreport-list')
                  <a
                    href="{{route('vitalreport.index')}}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white rounded enquiryactive"
                  >
                  {{__('label.sidenav_report_patientsvital')}}
                  </a>
                  @endcan

                </div>
                <div x-show="open" class="space-y-1 bg-gray-100" role="menu" arial-label="Product">
                  <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                  <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                  @can('diagnosisreport-list')
                  <a
                    href="{{route('diagnosisreport.index')}}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white rounded enquiryactive"
                  >
                  {{__('label.sidenav_diagnosis')}}
                  </a>
                  @endcan
                </div>
                <div x-show="open" class="space-y-1 bg-gray-100" role="menu" arial-label="Product">
                  <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                  <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                  @can('labreport-list')
                  <a
                    href="{{route('labreport.index')}}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white rounded enquiryactive"
                  >
                  {{__('label.sidenav_laboratory')}}
                  </a>
                  @endcan
                </div>

                <div x-show="open" class="space-y-1 bg-gray-100" role="menu" arial-label="Product">
                  <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                  <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                  @can('expirydrugreport-list')
                  <a
                    href="{{route('drugexpiryreport.index')}}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white rounded enquiryactive"
                  >
                  {{__('label.sidenav_report_expiry')}}
                  </a>
                </div>
                 @endcan
                <div x-show="open" class="space-y-1 bg-gray-100" role="menu" arial-label="Product">
                  <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                  <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                  @can('expiryalertdrugreport-list')
                  <a
                    href="{{route('drugalertreport.index')}}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white rounded enquiryactive"
                  >
                  {{__('label.sidenav_report_expiryalert')}}
                  </a>
                  @endcan
                </div>

                <div x-show="open" class="space-y-1 bg-gray-100" role="menu" arial-label="Product">
                  <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                  <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                
                  <a
                    href="{{route('pharmacystockreport.index')}}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white rounded enquiryactive"
                  >
                  {{ __('label.sidenav_pharmacystock') }}
                  </a>
                 
                </div>
                <div x-show="open" class="space-y-1 bg-gray-100" role="menu" arial-label="Product">
                  <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                  <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                
                  <a
                    href="{{route('inwarditemreport.index')}}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white rounded enquiryactive"
                  >
                  {{ __('label.sidenav_inward') }}
                  </a>
                 
                </div>

              

              </div>










              <div x-data="{ isActive: false, open: false}">
                <!-- active & hover classes 'bg-blue-100 dark:bg-blue-600' -->
                @can('settings')
                <a
                  href="{{ route('settings') }}"
                  class="flex items-center space-x-2 transition-colors settingsactive  hover:bg-blue-500 hover:text-white  py-2  rounded"
                >
                  <span aria-hidden="true">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                         <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z" />
                    </svg>
                  </span>
                  <span class="ml-2 text-sm">{{__('label.sidenav_settings')}}</span>
                </a>
                @endcan
              </div>
              <div x-data="{ isActive: true, open: false }" class="space-y-0.5">
                <!-- active classes 'bg-blue-100 dark:bg-blue-600' -->
                @can('trackings')
                <a
                  href="#"
                  @click="$event.preventDefault(); open = !open"
                  class="flex items-center py-2 transition-colors rounded-md  hover:bg-blue-500 hover:text-white loginlogsactive trackinglogsactive"
                  role="button"
                  aria-haspopup="true"
                  :aria-expanded="(open || isActive) ? 'true' : 'false'"
                >
                  <span aria-hidden="true">
                   <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.871 4A17.926 17.926 0 003 12c0 2.874.673 5.59 1.871 8m14.13 0a17.926 17.926 0 001.87-8c0-2.874-.673-5.59-1.87-8M9 9h1.246a1 1 0 01.961.725l1.586 5.55a1 1 0 00.961.725H15m1-7h-.08a2 2 0 00-1.519.698L9.6 15.302A2 2 0 018.08 16H8" />
                        </svg>

                  </span>
                  <span class="ml-2 text-sm"> {{__('label.sidenav_trackings')}} </span>
                  <span aria-hidden="true" class="ml-auto">
                    <!-- active class 'rotate-180' -->
                    <svg
                      class="w-4 h-4 transition-transform transform"
                      :class="{ 'rotate-180': open }"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </span>
                </a>
                @endcan
                <div x-show="open" class="space-y-1 bg-gray-100" role="menu" arial-label="Product">
                  <!-- active & hover classes 'text-gray-700 dark:text-light' -->
                  <!-- inActive classes 'text-gray-400 dark:text-gray-400' -->
                  @can('logininfo')
                  <a
                    href="{{ route('loginlogs') }}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white rounded loginlogsactive"
                  >
                  {{__('label.sidenav_logininfo')}}
                  </a>
                  @endcan
                  @can('useractivity')
                  <a
                    href="{{ route('trackinglogs') }}"
                    role="menuitem"
                    class="m-1 p-1 block text-sm  hover:bg-blue-500 hover:text-white rounded trackinglogsactive "
                  >
                  {{__('label.sidenav_useractivity')}}
                  </a>
                  @endcan
                </div>
              </div>
            </nav>
          </div>
        </div>
      </aside>
