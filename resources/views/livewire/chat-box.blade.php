<div class="text-sm">
    <!-- Chat Messages -->
    <div class="mb-3 max-h-64 overflow-y-auto space-y-3 px-2">
        @foreach($messages as $msg)
            <div class="flex {{ $msg->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-xs sm:max-w-md rounded-xl px-4 py-2 shadow relative
                    {{ $msg->sender_id == auth()->id() ? 'bg-purple-600 text-white' : 'bg-gray-100 text-gray-900' }}">
                    
                    {{-- File Preview --}}
                    @if($msg->file_path)
                        @if(Str::endsWith($msg->file_path, ['.jpg', '.jpeg', '.png', '.gif']))
                            <a href="{{ Storage::url($msg->file_path) }}" target="_blank">
                                <img src="{{ Storage::url($msg->file_path) }}" class="rounded mb-2 max-h-40 w-auto">
                            </a>
                        @else
                            <a href="{{ Storage::url($msg->file_path) }}" class="text-blue-300 underline block mb-1" target="_blank">
                                📎 Download File
                            </a>
                        @endif
                    @endif

                    {{-- Message Text --}}
                    @if($msg->content)
                        <p>{{ $msg->content }}</p>
                    @endif

                    {{-- Timestamp & Seen --}}
                    <div class="text-xs mt-1 text-right opacity-70">
                        {{ $msg->created_at->format('h:i A') }}
                        @if($msg->sender_id == auth()->id() && $msg->is_read)
                            <span class="ml-1">✔✔</span>
                        @endif
                    </div>

                    {{-- Delete (Only Self) --}}
                    @if($msg->sender_id == auth()->id())
                        <button wire:click="deleteMessage({{ $msg->id }})" title="Delete"
                            class="absolute -top-2 -right-2 text-xs text-red-300 hover:text-red-500 transition duration-150">
                            ✖
                        </button>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    {{-- Typing Indicator --}}
    <div id="typing-indicator" class="text-xs text-gray-400 px-2 hidden">
        💬 Typing...
    </div>

    <!-- Message Form -->
    <form wire:submit.prevent="sendMessage"
        class="flex items-center gap-2 border-t pt-3 px-2" x-data="{ showPicker: false }">

        <!-- Emoji Picker -->
        <button type="button" @click="showPicker = !showPicker" class="text-xl hover:scale-110">😊</button>
        <div x-show="showPicker" @click.outside="showPicker = false" class="absolute bottom-20 z-50">
            <emoji-picker @emoji-click="e => $wire.message += e.detail.unicode"></emoji-picker>
        </div>

        <!-- Message Input -->
        <input type="text" wire:model.defer="message"
            class="flex-1 border rounded-full px-4 py-2 focus:ring focus:border-purple-500"
            placeholder="Type your message..." wire:keydown="$dispatch('trainerIsTyping')">

        <!-- File Upload -->
        <label class="cursor-pointer">
            <input type="file" wire:model="file" class="hidden">
            <svg class="w-6 h-6 text-gray-500 hover:text-purple-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path d="M15.172 7l-6.586 6.586a2 2 0 002.828 2.828l7.071-7.071a4 4 0 00-5.656-5.656L4.929 13.243" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
            </svg>
        </label>

        <!-- Send -->
        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-full hover:bg-purple-700 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
    </form>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js" type="module"></script>
    <script>
        Livewire.on('trainerIsTyping', () => {
            const el = document.getElementById('typing-indicator');
            el?.classList.remove('hidden');
            setTimeout(() => el?.classList.add('hidden'), 2000);
        });
    </script>
</div>
