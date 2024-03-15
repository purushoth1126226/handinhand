        <!-- Navbar -->
        <header class="sticky top-0 flex items-center flex-shrink-0 w-full h-full bg-opacity-100 bg-blue-50 max-h-14">
            <!-- Menu Button -->
            <div class="flex items-center flex-shrink-0 xl:hidden">
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
            </div>
            <div class="flex items-center justify-between flex-1">
              <!-- Logo -->
              <a
                href="#"
                :class="{'xl:hidden ml-2':isSidebarOpen, 'block ml-2':!isSidebarOpen}"
                class="flex-shrink-0 text-2xl font-bold tracking-widest text-yellow-500 uppercase"
              >
              CLINIC
              </a>

              <nav class="relative flex items-center justify-end flex-1 ml-3 lg:justify-start">
                <!-- Search Button -->
                {{-- <div x-data="{ searchOpen: false, searchResult: false }">
                  <button
                    @click="searchOpen = !searchOpen"
                    class="inline-block p-2 bg-blue-100 rounded-full hover:bg-blue-200"
                  >
                    <svg
                      class="w-6 h-6"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                      />
                    </svg>
                  </button>
                  <!-- Search box -->
                  <div
                    @click.away="searchOpen = false"
                    x-show.transition="searchOpen"
                    class="fixed left-0 ml-2 right-6 lg:max-w-md lg:-ml-1 lg:absolute"
                  >
                    <div class="p-4 mt-4 bg-white shadow-lg rounded-t-md">
                      <div class="flex items-center">
                        <input
                          type="text"
                          placeholder="Search..."
                          class="w-full px-4 py-2 bg-blue-100 rounded-l-md focus:outline-none"
                          @focus="searchResult = true"
                          @blur="searchResult = false"
                        />
                        <button
                          class="p-2 text-white bg-blue-500 rounded-r-md focus:outline-none hover:bg-blue-600 focus:bg-blue-700"
                        >
                          <svg
                            class="w-6 h-6"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            />
                          </svg>
                        </button>
                      </div>
                    </div>
                    <!-- Search Result -->
                    <div
                      x-show.transition="searchResult"
                      class="p-4 overflow-y-auto bg-white shadow-lg rounded-b-md h-72"
                    >
                      <ul>
                        <template x-for="i in 10" :key="i">
                          <li>
                            <a href="#" class="block px-4 py-2 rounded-md hover:bg-blue-100">Result</a>
                          </li>
                        </template>
                      </ul>
                    </div>
                  </div>
                </div> --}}
                <!-- Right Links -->
                <ul class="flex items-center justify-center ml-auto mr-2 space-x-2 lg:mr-5">
                  <!-- Settings Button -->
                  <!-- Notifications Button -->
                  <li>
                    <!-- <span>{{ __('label.language') }}</span> -->
                    <form  action="{{route('switchlanguage')}}" method="post">
                     @csrf
                        <select name="language" class="form-select block w-full focus:bg-white p-1" id="language" onchange="this.form.submit()" readonly>
                        <option value="1" {{ (Auth::user()->language == 1) ? 'selected':''}}>English</option>
                         <option value="2"  {{ (Auth::user()->language == 2) ? 'selected':''}} >Tamil</option>
                      </select>
                   </form>


                  </li>
                  <!-- Avatar Button -->
                  <li>

                        <!-- avatar button -->
                        <div class="relative" x-data="{ isOpen: false }">
                          <button @click="isOpen = !isOpen" class="p-1 bg-gray-200 rounded-full focus:outline-none focus:ring">
                            <img
                              class="object-cover w-8 h-8 rounded-full"
                              src="{{asset('admin/person.png')}}"
                              alt="MOB"
                            />

                          </button>
                          <!-- green dot -->
                          <div class="absolute right-0 p-1 bg-green-400 rounded-full bottom-3 animate-ping"></div>
                          <div class="absolute right-0 p-1 bg-green-400 border border-white rounded-full bottom-3"></div>

                          <!-- Dropdown card -->
                          <div
                            @click.away="isOpen = false"
                            x-show.transition.opacity="isOpen"
                            class="absolute mt-3 transform -translate-x-full bg-white rounded-md shadow-lg min-w-max"
                          >
                            <div class="flex flex-col p-4 space-y-1 font-medium border-b">
                              <span class="text-gray-800">{{ Auth()->user()->name }}</span>
                              <span class="text-sm text-gray-400">{{ Auth()->user()->email }}</span>
                            </div>
                            <ul class="flex flex-col p-2 my-2 space-y-1">
                              <li>
                                <a href="{{ route('profile') }}" class="block px-2 py-1 transition rounded-md hover:bg-gray-100">Profile</a>
                              </li>
                              <li>
                                <a href="{{ route('2fa') }}" class="block px-2 py-1 transition rounded-md hover:bg-gray-100">2FA</a>
                              </li>
                              <li>
                                <a href="{{ route('changepasswordform') }}" class="block px-2 py-1 transition rounded-md hover:bg-gray-100">Change Password</a>
                              </li>
                            </ul>
                            <div class="flex items-center justify-center p-3 text-blue-700  border-t">
                              <a class="block px-4 py-2 text-red-500" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                               {{ __('Logout') }}
                           </a>
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                               @csrf
                           </form>
                            </div>
                          </div>
                        </div>





                  </li>
                </ul>
              </nav>
            </div>
          </header>
