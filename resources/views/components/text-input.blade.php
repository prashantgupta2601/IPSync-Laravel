@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 focus:border-[#C4B5FD] focus:ring-[#C4B5FD] rounded-md shadow-sm']) }}>
