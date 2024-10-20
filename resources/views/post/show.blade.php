 <x-app-layout>
   <div class="flex justify-center mt-4 p-6 ">
     <div class="relative w-1/5">
       <input
         class="bg-white w-full pr-11 h-10 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
         placeholder="Search for product..." />
       <button
         class="absolute h-8 w-8 right-1 top-1 my-auto px-2 flex items-center bg-white rounded "
         type="button">
         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-8 h-8 text-slate-600">
           <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
         </svg>
       </button>
     </div>
     <div class=" w-1/4 flex items-center justify-end">
       <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150']) }}>"
         href="{{route('posts.create')}}">Add post</a>
     </div>
   </div>
   @foreach($posts as $item)

   <body class="bg-gray-100">
     <div class="max-w-4xl mx-auto p-6 lg:p-8 mt-8 bg-white border border-gray-200 rounded-xl">
       <div class="flex  justify-end">
         <a href="">
           <svg class="h-5 w-5 text-black" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
             <path stroke="none" d="M0 0h24v24H0z" />
             <path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
             <circle cx="12" cy="12" r="3" />
           </svg>
         </a>
       </div>
       <section>
         <div class="text-center">
           <p class="text-2xl font-bold mb-4">{{$item->title}}</p>
         </div>
         <!-- Slider de imágenes -->
         {!! $item->description !!}
         <!-- Datos de la publicación -->
         <div class="mt-6 pb-6">
           <p class="mt-4">📬 <strong>Dirección:</strong> Calle 14-25, Zona 3, Quetzaltenango</p>
           <p>📅 <strong>Fecha: </strong>{{$item->date_event}} 🕓 <strong>Hora:</strong> {{$item->time_event}} hrs</p>
           <p><strong>Límite de personas:</strong> {{$item->capacity}}</p>
           <p><strong>Personas confirmadas:</strong> {{$item->confirmed}}</p>
         </div>
       </section>
     </div>
     <!-- Swiper JS -->
     <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
     <script>
       var swiper = new Swiper(".mySwiper", {
         slidesPerView: 1,
         spaceBetween: 30,
         loop: true,
         pagination: {
           el: ".swiper-pagination",
           clickable: true,
         },
         navigation: {
           nextEl: ".swiper-button-next",
           prevEl: ".swiper-button-prev",
         },
       });
     </script>

     <style>
       /* Asegurando que las flechas sean visibles sobre el fondo */
       .swiper-button-next,
       .swiper-button-prev {
         color: white;
         /* Color de las flechas */
       }
     </style>
   </body>
   @endforeach
 </x-app-layout>