<x-admin-layout :breadcrumb="[
    ['name' => 'Home'],
    ['name' => 'Dashboard']
]">


  

@if ($dashboard->isNotEmpty()) <!-- Fixed the typo here from $dahboard to $dashboard -->


<div class="grid grid-cols- md:grid-cols-3 gap-6">
    <!-- Usuarios -->
    <div class="max-w-sm w-full bg-gradient-to-br from-blue-500 to-purple-600
     text-white rounded-lg shadow-lg p-3 transition-transform hover:scale-105 duration-300 relative overflow-hidden">
        <div class="flex justify-between items-center mb-5">
            <div class="flex items-center gap-3">
                <div class="p-3 bg-white rounded-full">
                    <i class="fa-solid fa-users text-blue-600 text-xl"></i>
                </div>
                <span class="text-lg font-semibold">Usuarios</span>
            </div>
            <span class="text-2xl font-bold">{{ $users->count() }}</span>
        </div>
    </div>
    

    <!-- Comentarios -->
    <div class="max-w-sm w-full bg-gradient-to-br from-green-500 to-teal-600
     text-white rounded-lg shadow-lg p-3   transition-transform hover:scale-105 duration-300 relative overflow-hidden">
        <div class="flex justify-between items-center mb-5">
            <div class="flex items-center gap-3">
                <div class="p-3 bg-white rounded-full">
                    <i class="fa-solid fa-comments text-green-600 text-xl"></i>
                </div>
                <span class="text-lg font-semibold">Comentarios</span>
            </div>
            <span class="text-2xl font-bold">{{ $totalComments }}</span>
        </div>
    </div>

    <!-- Posts -->
    <div class="max-w-sm w-full bg-gradient-to-br from-red-500
     to-orange-600 text-white rounded-lg shadow-lg p-3  transition-transform hover:scale-105 duration-300 relative overflow-hidden">
        <div class="flex justify-between items-center mb-5">
            <div class="flex items-center gap-3">
                <div class="p-3 bg-white rounded-full">
                    <i class="fa-solid fa-pen text-red-600 text-xl"></i>
                </div>
                <span class="text-lg font-semibold">Publicaciones</span>
            </div>
            <span class="text-2xl font-bold">{{ $posts->count() }}</span>
        </div>
    </div>

    

</div>


<div class="dashboard mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
    
    <!-- Logo -->
    <div class="logo">
        <ul class="space-y-8  bg-white shadow-lg rounded-lg  transition-transform hover:scale-105 duration-300 relative overflow-hidden">
            @foreach ($dashboard as $panel)
                <li class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    
                    <div>
                        <a href="{{ route('admin.dashboard.edit', $panel) }}">
                            <img class="aspect-[16/9] object-cover object-center w-full rounded-lg" 
                                 src="{{ asset('storage/' . $panel->image_path_logo) }}" alt="{!! $panel->title !!}">
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('admin.dashboard.edit', $panel) }}" class="text-xl font-semibold">
                            {!! $panel->title_logo !!}
                        </a>
                        <div class="mt-2">
                            <a href="{{route('admin.dashboard.edit', $panel)}}" class="mr-2 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Editar logo
                            </a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Banner -->
    <div class="banner">
        <ul class="  bg-white shadow-lg rounded-lg  transition-transform hover:scale-105 duration-300 relative overflow-hidden">
            @foreach ($dashboard as $panel)
                <li class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div>
                        <a href="{{ route('admin.dashboard.edit', $panel) }}">
                            <img class="aspect-[16/9] object-cover object-center w-full rounded-lg" 
                                 src="{{ asset('storage/' . $panel->image_path_banner) }}" alt="{!! $panel->title !!}">
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('admin.dashboard.edit', $panel) }}" class="text-xl font-semibold">
                            {!! $panel->title_banner !!}
                        </a>
                        <div class="mt-2">
                            <a href="{{route('admin.dashboard.edit', $panel)}}" class="mr-2 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Editar banner
                            </a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

{{-- Los 10 post con mas comentario --}}


<div class="w-full mt-4 max-w-md p-4 bg-white border border-gray-200 rounded-lg shadow-lg sm:p-8
 dark:bg-gray-800 dark:border-gray-700
     transition-transform hover:scale-105 duration-300 relative overflow-hidden">
    
    <div class="flex items-center justify-between mb-4">
        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Los 10 post con màs comentarios</h5>
       
   </div>
  
       
   <div class="flex mt-4  ">
        <ul role="list" class="divide-y   divide-gray-200 dark:divide-gray-700">

            @foreach ($posts as $post)
            <li class="py-3 sm:py-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img class="w-8 h-8 rounded-full" src="{{ $post->image }}" alt="Neil image">
                    </div>
                    <div class="flex-1 min-w-0 ms-4">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                            {!! $post->title !!}
                        </p>
                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                            {{ Str::limit(strip_tags($post->excerpt), 30) }}
                        </p>
                    </div>
                    <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                        <span class="mr-2">{{ $post->questions_count }}</span> comentarios
                     </div>
                </div>
            </li>
            @endforeach
        </ul>
    
       
        
   </div>
</div>


@else
    <p>No hay elementos en el panel .</p>
@endif

</x-admin-layout>
