<x-app-layout>
    <x-slot name="header">
        Book a Consultation
    </x-slot>

    <div class="max-w-2xl mx-auto mt-4">
        <form action="{{ route('appointments.store') }}" method="POST" class="bg-[#0A0A0A] border border-white/10 rounded-xl overflow-hidden p-6 md:p-8">
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

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Select IP Expert</label>
                    <select name="expert_id" required class="w-full bg-black border border-white/10 rounded-lg text-gray-200 focus:border-[#C4B5FD] focus:ring-1 focus:ring-[#C4B5FD] px-4 py-3">
                        <option value="">Choose an expert...</option>
                        @foreach($experts as $expert)
                            <option value="{{ $expert->id }}" {{ old('expert_id') == $expert->id ? 'selected' : '' }}>{{ $expert->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Date & Time</label>
                    <input type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at') }}" required class="w-full bg-black border border-white/10 rounded-lg text-gray-200 focus:border-[#C4B5FD] focus:ring-1 focus:ring-[#C4B5FD] px-4 py-3 [color-scheme:dark]">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-400 mb-2">Meeting Notes / Agenda</label>
                    <textarea name="notes" rows="4" placeholder="Briefly describe what you would like to discuss..." class="w-full bg-black border border-white/10 rounded-lg text-gray-200 focus:border-[#C4B5FD] focus:ring-1 focus:ring-[#C4B5FD] px-4 py-3">{{ old('notes') }}</textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-8">
                <a href="{{ route('appointments.index') }}" class="px-5 py-2.5 rounded-lg text-sm font-medium text-gray-300 hover:text-white transition-colors">Cancel</a>
                <button type="submit" class="bg-[#C4B5FD] hover:bg-[#A78BFA] text-black px-6 py-2.5 rounded-lg text-sm font-semibold shadow-[0_0_15px_rgba(196,181,253,0.3)] transition-all">Confirm Booking</button>
            </div>
        </form>
    </div>
</x-app-layout>
