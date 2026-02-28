@props(['size' => 'h-10 w-10', 'border' => 'border-2', 'rounded' => 'rounded-full'])

<div {{ $attributes->merge(['class' => "profile-container relative inline-block $size aspect-square $rounded transition-all duration-300"]) }} style="z-index: 5;">
    <!-- Main Circular Container -->
    <div class="h-full w-full {{ $rounded }} overflow-hidden {{ $border }} border-gray-200 dark:border-gray-700 shadow-sm transition-all duration-300 hover:shadow-md hover:border-indigo-400 dark:hover:border-indigo-500 bg-gray-100 dark:bg-gray-800 flex items-center justify-center relative" style="z-index: 10;">
        @if(Auth::check() && Auth::user()->profile_photo)
            <img src="{{ route('profile.photo.show', ['filename' => basename(Auth::user()->profile_photo)]) }}" 
                 class="h-full w-full object-cover aspect-square {{ $rounded }}" 
                 alt="Profile"
                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
            <span class="material-symbols-outlined text-gray-400 hidden">person</span>
        @else
            <span class="material-symbols-outlined text-gray-400">person</span>
        @endif

        <!-- Default slot for elements like the loading spinner -->
        {{ $slot }}
    </div>

    <!-- Actions slot (e.g. Upload button) - Placed outside the clipped container -->
    @if(isset($actions))
        {{ $actions }}
    @endif
</div>
