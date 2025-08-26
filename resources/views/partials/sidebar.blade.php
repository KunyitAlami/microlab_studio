<aside id="sidebar-multi-level-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-gray-100 dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
         <li>
            <a class="flex items-center p-2 ">
               <img src="icon.png" class="h-12 w-12">
               <div class="flex flex-col text-center">
                  <span class="text-[#87CBB9] text-3xl font-extrabold ml-4">MicroLab</span>
                  <span class="text-[#87CBB9] text-3xl font-extrabold ml-4">Virtual</span>
               </div>
            </a>
         </li>

         <li class="mt-4">
            <a href="{{ url('/') }}" class="flex items-center p-2 ml-4">
               <svg class="mr-5 shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-white dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                  <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
               </svg>
               <span class="flex-1 ms-3 text-black text-md mt-2">Dashboard</span>
            </a>
            <a href="{{ url('/article') }}" class="flex items-center p-2 ml-4">
               <svg class="w-5 h-5 mr-5" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="currentColor"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:#000000;} </style> <g> <rect x="106.667" y="106.667" class="st0" width="298.666" height="106.666"></rect> <path class="st0" d="M0,0v512h512V0H0z M458.667,458.667H53.333V53.333h405.334V458.667z"></path> <rect x="106.667" y="277.333" class="st0" width="298.666" height="32"></rect> <rect x="106.667" y="362.667" class="st0" width="298.666" height="32"></rect> </g> </g>
               </svg>
               <span class="flex-1 ms-3 text-black text-md mt-1 ml-12">Article</span>
            </a>
         </li>

      </ul>
   </div>
</aside>