<x-layouts.app :userName="$employee_name">
    <x-slot:title>View Document</x-slot>

    <x-document.detail-view 
        :document="$document" 
        :userName="$employee_name" 
        :backRoute="route('employee.home')"
    />
</x-layouts.app>
