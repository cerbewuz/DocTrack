<x-layouts.app :userName="$admin_name">
    <x-slot:title>Admin - View Document</x-slot>

    <x-document.detail-view 
        :document="$document" 
        :userName="$admin_name" 
        :backRoute="route('admin.home')"
    />
</x-layouts.app>
