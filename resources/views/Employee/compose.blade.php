<x-layouts.app :userName="$employee_name">
    <x-slot:title>Compose Document</x-slot>

    <div class="max-w-4xl mx-auto space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Compose New Document</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Fill out the form below to track a new document.</p>
        </div>

        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const isDark = localStorage.getItem('dark-mode') === 'enabled';
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: "{{ session('success') }}",
                        confirmButtonColor: '#4f46e5',
                        background: isDark ? '#1f2937' : '#fff',
                        color: isDark ? '#fff' : '#1f2937',
                        customClass: {
                            popup: 'rounded-3xl',
                            confirmButton: 'rounded-xl px-6 py-2.5 font-bold'
                        }
                    });
                });
            </script>
        @endif

        <x-document.compose-form 
            :actionRoute="route('employee.compose.store')"
            :users="$users"
            :prioritizations="$prioritizations"
            :classifications="$classifications"
            :subclassifications="$subclassifications"
            :actions="$actions"
        />
    </div>
</x-layouts.app>
