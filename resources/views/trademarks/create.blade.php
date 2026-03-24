<x-app-layout>
    <x-slot name="header">
        Submit New Trademark
    </x-slot>

    <div class="max-w-4xl mx-auto mt-4">
        <form action="{{ route('trademarks.store') }}" method="POST" enctype="multipart/form-data" class="bg-[#0A0A0A] border border-white/10 rounded-xl overflow-hidden p-6 md:p-8">
            @csrf

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-lg">
                    <ul class="list-disc list-inside text-sm text-red-400">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-gray-400 mb-2">Trademark Name / Mark</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full bg-black border border-white/10 rounded-lg text-gray-200 focus:border-[#C4B5FD] focus:ring-1 focus:ring-[#C4B5FD] px-4 py-3">
                </div>

                <div class="col-span-1">
                    <label class="block text-sm font-medium text-gray-400 mb-2">Owner Name</label>
                    <input type="text" name="owner_name" value="{{ old('owner_name') }}" required class="w-full bg-black border border-white/10 rounded-lg text-gray-200 focus:border-[#C4B5FD] focus:ring-1 focus:ring-[#C4B5FD] px-4 py-3">
                </div>

                <div class="col-span-1">
                    <label class="block text-sm font-medium text-gray-400 mb-2">Category (Class)</label>
                    <input type="text" name="category" value="{{ old('category') }}" placeholder="e.g. Class 25 (Clothing)" required class="w-full bg-black border border-white/10 rounded-lg text-gray-200 focus:border-[#C4B5FD] focus:ring-1 focus:ring-[#C4B5FD] px-4 py-3">
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-gray-400 mb-2">Description of Goods/Services</label>
                    <textarea name="description" rows="4" required class="w-full bg-black border border-white/10 rounded-lg text-gray-200 focus:border-[#C4B5FD] focus:ring-1 focus:ring-[#C4B5FD] px-4 py-3">{{ old('description') }}</textarea>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-gray-400 mb-2">Supporting Documents (Specimen/Logo)</label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-white/10 border-dashed rounded-lg cursor-pointer bg-black hover:bg-white/[0.02] transition-colors">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                <p class="mb-2 text-sm text-gray-400"><span class="font-semibold text-[#C4B5FD]">Click to upload</span> or drag and drop</p>
                                <p class="text-xs text-gray-500">PDF, JPG, PNG (Max 10MB per file)</p>
                            </div>
                            <input type="file" name="documents[]" multiple class="hidden" accept=".pdf,.jpg,.jpeg,.png" />
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('trademarks.index') }}" class="px-5 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:text-white transition-colors">Cancel</a>
                <button type="submit" class="bg-[#C4B5FD] hover:bg-[#A78BFA] text-black px-6 py-2.5 rounded-lg text-sm font-semibold shadow-[0_0_15px_rgba(196,181,253,0.3)] transition-all">Submit Trademark</button>
            </div>
        </form>
    </div>
</x-app-layout>
