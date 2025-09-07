<aside id="sidebar-multi-level-sidebar"
   class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
   aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-gray-100 dark:bg-gray-800">
      <ul class="space-y-2 font-medium">

         <!-- Logo -->
         <li>
            <a class="flex items-center p-2">
               <img src="icon.png" class="h-12 w-12">
               <div class="flex flex-col text-center">
                  <span class="text-[#87CBB9] text-3xl font-extrabold ml-4">MicroLab</span>
                  <span class="text-[#87CBB9] text-3xl font-extrabold ml-4">Virtual</span>
               </div>
            </a>
         </li>

         <!-- Menu -->
         <li class="mt-4 gap-12">

            {{-- Dashboard --}}
            <a href="{{ url('/') }}"
               class="flex items-center p-2 ml-4 rounded-lg transition duration-200 
               {{ Request::is('/') ? 'bg-green-100 text-green-600 font-semibold' : 'text-gray-600 hover:bg-green-50 hover:text-green-600' }}">
               <svg class="mr-5 w-5 h-5 shrink-0 {{ Request::is('/') ? 'text-green-600' : 'text-gray-500 group-hover:text-green-600' }}"
                  xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                  <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
               </svg>
               <span class="flex-1 ms-3 text-md">Dashboard</span>
            </a>

            {{-- Article --}}
            <a href="{{ url('/article') }}"
               class="flex items-center p-2 ml-4 rounded-lg transition duration-200 
               {{ Request::is('article*') ? 'bg-green-100 text-green-600 font-semibold' : 'text-gray-600 hover:bg-green-50 hover:text-green-600' }}">
               <svg class="w-5 h-5 mr-5 {{ Request::is('article*') ? 'text-green-600' : 'text-gray-500 group-hover:text-green-600' }}"
                  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor">
                  <rect x="106.667" y="106.667" width="298.666" height="106.666" />
                  <path d="M0,0v512h512V0H0z M458.667,458.667H53.333V53.333h405.334V458.667z" />
                  <rect x="106.667" y="277.333" width="298.666" height="32" />
                  <rect x="106.667" y="362.667" width="298.666" height="32" />
               </svg>
               <span class="flex-1 ms-3 text-md">Article</span>
            </a>

            {{-- Feedback --}}
            <a href="{{ url('/feedback') }}"
               class="flex items-center p-2 ml-4 rounded-lg transition duration-200 
               {{ Request::is('feedback*') ? 'bg-green-100 text-green-600 font-semibold' : 'text-gray-600 hover:bg-green-50 hover:text-green-600' }}">
               <svg class="w-5 h-5 mr-5 {{ Request::is('feedback*') ? 'text-green-600' : 'text-gray-500 group-hover:text-green-600' }}" 
                  fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M22,1H15a2.44,2.44,0,0,0-2.41,2l-.92,5.05a2.44,2.44,0,0,0,.53,2,2.47,2.47,0,0,0,1.88.88H17l-.25.66A3.26,3.26,0,0,0,19.75,16a1,1,0,0,0,.92-.59l2.24-5.06A1,1,0,0,0,23,10V2A1,1,0,0,0,22,1ZM21,9.73l-1.83,4.13a1.33,1.33,0,0,1-.45-.4,1.23,1.23,0,0,1-.14-1.16l.38-1a1.68,1.68,0,0,0-.2-1.58A1.7,1.7,0,0,0,17.35,9H14.06a.46.46,0,0,1-.35-.16.5.5,0,0,1-.09-.37l.92-5A.44.44,0,0,1,15,3h6ZM9.94,13.05H7.05l.25-.66A3.26,3.26,0,0,0,4.25,8a1,1,0,0,0-.92.59L1.09,13.65a1,1,0,0,0-.09.4v8a1,1,0,0,0,1,1H9a2.44,2.44,0,0,0,2.41-2l.92-5a2.44,2.44,0,0,0-.53-2A2.47,2.47,0,0,0,9.94,13.05Zm-.48,7.58A.44.44,0,0,1,9,21H3V14.27l1.83-4.13a1.33,1.33,0,0,1,.45.4,1.23,1.23,0,0,1,.14,1.16l-.38,1a1.68,1.68,0,0,0,.2,1.58,1.7,1.7,0,0,0,1.41.74H9.94a.46.46,0,0,1,.35.16.5.5,0,0,1,.09.37Z"></path>
               </svg>
               <span class="flex-1 ms-3 text-md">Feedback</span>
            </a>


         </li>
      </ul>
   </div>
</aside>