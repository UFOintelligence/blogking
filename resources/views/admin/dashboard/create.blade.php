<x-admin-layout :breadcrumb="[
    ['name' => 'Home', 'url' => route('home')],
    ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
    ['name' => 'Nuevo']
]">


<form action="{{ route('admin.dashboard.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
        <x-label for="title_logo">Título del Logo</x-label>
        <x-input type="text" name="title_logo" />
    </div>

    <div>
        <x-label for="image_logo">Logo</x-label>
        <input type="file" name="image_logo" />
    </div>

    <div>
        <x-label for="title_banner">Título del Banner</x-label>
        <x-input type="text" name="title_banner" />
    </div>

    <div>
        <x-label for="image_banner">Banner</x-label>
        <input type="file" name="image_banner" />
    </div>

    <button type="submit">Crear</button>
</form>


</x-admin-layout>
