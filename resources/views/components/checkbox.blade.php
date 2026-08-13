@props([
    'is_active' => false,
    'name' => '',
])
<div
    {{ $attributes->merge() }}
    class="group flex cursor-pointer items-start gap-2.5 {{ $is_active ? 'active' : '' }}"
>
    <div
        class="relative h-3 w-3 mt-[3px] border group-hover:border-none group-hover:!bg-grey shrink-0 group-[.active]:bg-tertiary group-[.active]:border-none transition-colors duration-300">
        <span
            class="absolute left-0 top-1/2 h-px w-3 -translate-y-1/2 bg-tertiary opacity-0 transition-opacity group-hover:opacity-100"
        ></span>
        <span
            class="absolute left-1/2 top-0 h-3 w-px -translate-x-1/2 bg-tertiary opacity-0 transition-opacity group-hover:opacity-100"
        ></span>
    </div>
    <p
        class="text-[14px] transition-colors leading-[normal] duration-300 group-[.active]:text-tertiary group-hover:!text-primary">
        {!! $name !!}
    </p>
</div>
