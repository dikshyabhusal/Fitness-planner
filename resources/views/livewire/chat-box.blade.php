<div>
    <!-- Messages -->
    <div class="mb-4 max-h-64 overflow-y-auto space-y-2">
        @foreach($messages as $msg)
            @if($msg->sender_id == auth()->id())
                <div class="text-right">
                    <span class="inline-block bg-purple-600 text-white px-4 py-2 rounded-lg">
                        {{ $msg->content }}
                    </span>
                </div>
            @else
                <div class="text-left">
                    <span class="inline-block bg-gray-100 text-black px-4 py-2 rounded-lg">
                        {{ $msg->content }}
                    </span>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Send Message Form -->
    <form wire:submit.prevent="sendMessage" class="flex space-x-2">
        <input
            type="text"
            wire:model="message"
            placeholder="Type your message..."
            class="flex-1 border px-3 py-2 rounded focus:outline-none"
        >
        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
            Send
        </button>
    </form>
</div>
