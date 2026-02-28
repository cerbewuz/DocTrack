@props(['height' => 'h-10'])

<div {{ $attributes->merge(['class' => "logo-container inline-flex items-center justify-center $height transition-all duration-300"]) }}>
    <div class="relative h-full w-auto aspect-square flex items-center justify-center">
        {{ $slot }}
    </div>
</div>
