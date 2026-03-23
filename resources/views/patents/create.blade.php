<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('patents.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <span>Submit a New Patent Action</span>
        </div>
    </x-slot>

    <div class="bg-white rounded-xl border border-gray-100 p-8 shadow-sm max-w-4xl mx-auto">
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-900">Patent Information</h3>
            <p class="text-sm text-gray-500 mt-1">Please provide detailed information about your invention. Our experts will review it securely.</p>
        </div>

        <form class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Patent Title</label>
                    <input type="text" class="w-full border-gray-200 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2" placeholder="e.g. Quantum Processor Design">
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select class="w-full border-gray-200 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2">
                        <option>Utility Patent</option>
                        <option>Design Patent</option>
                        <option>Plant Patent</option>
                    </select>
                </div>

                <!-- Inventor -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Primary Inventor</label>
                    <input type="text" class="w-full border-gray-200 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2" value="{{ auth()->user()->name }}">
                </div>

                <!-- Description -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Abstract / Description</label>
                    <textarea rows="4" class="w-full border-gray-200 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2" placeholder="Briefly describe the invention..."></textarea>
                </div>
                
                <!-- File Upload (Alpine.js integration for visual feedback) -->
                <div class="md:col-span-2 mt-4" x-data="{ fileName: '', dragOver: false }">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Technical Drawings & Documents</label>
                    <div 
                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-lg transition-colors cursor-pointer relative"
                        :class="dragOver ? 'border-indigo-500 bg-indigo-50' : 'border-gray-300 hover:bg-gray-50'"
                        @dragover.prevent="dragOver = true"
                        @dragleave.prevent="dragOver = false"
                        @drop.prevent="dragOver = false; if($event.dataTransfer.files.length) { fileName = $event.dataTransfer.files[0].name; $refs.fileInput.files = $event.dataTransfer.files }"
                    >
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true" x-show="!fileName">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <!-- File Icon when selected -->
                            <svg class="mx-auto h-12 w-12 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="fileName" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            
                            <div class="flex text-sm text-gray-600 justify-center flex-col items-center">
                                <label for="file-upload" class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span x-text="fileName ? 'Change file' : 'Upload a file'"></span>
                                    <input id="file-upload" name="documents" type="file" class="sr-only" x-ref="fileInput" @change="fileName = $refs.fileInput.files[0].name" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg">
                                </label>
                                <p class="pl-1" x-show="!fileName">or drag and drop</p>
                                <p class="mt-2 text-indigo-800 font-semibold" x-show="fileName" x-text="fileName" style="display: none;"></p>
                            </div>
                            <p class="text-xs text-gray-500" x-show="!fileName">PDF, DOC, PNG, JPG up to 10MB</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 flex justify-end gap-3">
                <button type="button" class="px-5 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50">Cancel</button>
                <button type="submit" class="px-5 py-2 shadow-sm text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700">Submit Application</button>
            </div>
        </form>
    </div>
</x-app-layout>
