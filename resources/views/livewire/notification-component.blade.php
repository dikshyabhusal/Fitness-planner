
<div class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="relative">
        🔔
        @if(!empty($unreadMessages) && count($unreadMessages))
            <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs px-2 py-1 rounded-full">
                {{ count($unreadMessages) }}
            </span>
        @endif
    </button>

    <div x-show="open" class="absolute right-0 mt-2 bg-white text-black rounded shadow w-64 z-50">
        <div class="p-2 text-sm font-semibold text-gray-700 border-b">💬 Chat Contacts</div>
        <ul>
            @forelse($allSenders as $user)
                <li 
                    x-data
                    x-init="$el.addEventListener('click', () => Livewire.dispatch('openChatWith', { senderId: {{ $user->id }} }))"
                    class="p-2 hover:bg-gray-100 cursor-pointer"
                >
                    {{ $user->name }}

                    @if(isset($unreadMessages[$user->id]))
                        <span class="text-xs text-red-600 font-semibold ml-2">• new</span>
                    @endif
                </li>
            @empty
                <li class="p-2 text-gray-500">No contacts yet</li>
            @endforelse
        </ul>
    </div>
</div>
