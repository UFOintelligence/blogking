<x-admin-layout :breadcrumb="[
     ['name' => 'Home', 'url' => route('home')],
     ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
    ['name' => 'Editar']
]">



 <form action="{{ route('admin.dashboard.update', $dashboard->id) }}" method="POST" enctype="multipart/form-data">


    @csrf
    @method('PUT')


    <x-validation-errors class="mb-4" />  
    <div class="dashboard grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
    
        <!-- Logo -->
        <div class="logo">
            <ul class="space-y-8  bg-white shadow-lg rounded-lg  transition-transform hover:scale-105 duration-300 relative overflow-hidden">
                
                    <li class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        
                        <div>
                            <figure>
                                <img class="aspect-[16/9] object-cover object-center w-full" src="{{ asset('storage/' . $dashboard->image_path_logo) }}" alt="no imagen"
                                    id="imgPreviewLogo">
                            </figure>
                        </div>
                        <div class="absolute top-8 ">

                            <label class="bg-white px-4 py-2 rounded-lg cursor-pointer">
            
                                <i class="fa-solid fa-camera mr-2"></i>
                                Actualizar Imagen
                                <input type="file" accept="image/*" name="logo" class="hidden"
                                    onchange="previewImageLogo(event, '#imgPreviewLogo')">
            
                            </label>
            
                        </div>
                        <div>
                       <div class="mb-4">
                            <x-label class="mb-1">
                                Nombre
                            </x-label>
                
                            <x-input class="w-full" placeholder="Escriba el titulo del logo" name="title_logo"
                                value="{{ old('title_logo', $dashboard->title_logo ) }}"></x-input>
                        </div>
                            <div class=" mt-2">
                                
                            
                                <x-button>Actualizar logo</x-button>
                            </div>
                        </div>
                    </li>
            </ul>
        </div>
    
        <!-- Banner -->
        <div class="banner">
            <ul class="space-y-8  bg-white shadow-lg rounded-lg  transition-transform hover:scale-105 duration-300 relative overflow-hidden">
                    <li class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div>
                            <figure>
                                <img class="aspect-[16/9] object-cover object-center w-full"
                                 src="{{ asset('storage/' . $dashboard->image_path_banner) }}" alt="no imagen"
                                    id="imgPreviewBanner">
                            </figure>
                        </div>
                        <div class="absolute top-8 ">

                            <label class="bg-white px-4 py-2 rounded-lg cursor-pointer">
            
                                <i class="fa-solid fa-camera mr-2"></i>
                                Actualizar Imagen
                                <input type="file" accept="image/*" name="banner" class="hidden"
                                    onchange="previewImageBanner(event, '#imgPreviewBanner')">
            
                            </label>
            
                        </div>
                         <div>
                          
                     <x-button>Actualizar banner</x-button>

                        </div> 

                    </li>
            </ul>
        </div>
    
    </div>



</form>







@push('js')

<script>
        function deleteDashboard() {

let form = document.getElementById('formDeleteDashboard');
form.submit();

}

// Funcion para cargar la imagen del logo

function previewImageLogo(event, querySelector) {

//Recuperamos el input que desencadeno la acción
const input = event.target;

//Recuperamos la etiqueta img donde cargaremos la imagen
$imgPreview = document.querySelector(querySelector);

// Verificamos si existe una imagen seleccionada
if (!input.files.length) return

//Recuperamos el archivo subido
file = input.files[0];

//Creamos la url
objectURL = URL.createObjectURL(file);

//Modificamos el atributo src de la etiqueta img
$imgPreview.src = objectURL;

}

//  Funcion para cargar la imagen del banner
    function previewImageBanner(event, querySelector) {

//Recuperamos el input que desencadeno la acción
const input = event.target;

//Recuperamos la etiqueta img donde cargaremos la imagen
$imgPreview = document.querySelector(querySelector);

// Verificamos si existe una imagen seleccionada
if (!input.files.length) return

//Recuperamos el archivo subido
file = input.files[0];

//Creamos la url
objectURL = URL.createObjectURL(file);

//Modificamos el atributo src de la etiqueta img
$imgPreview.src = objectURL;

}

</script>
    
@endpush
</x-admin-layout>
