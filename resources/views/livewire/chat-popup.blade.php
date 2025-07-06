<div>
    @if($show && $selectedUser && $selectedUser instanceof \App\Models\User)
        <div class="fixed bottom-4 right-6 w-96 bg-white border rounded shadow z-50">
            
            <div class="bg-purple-600 text-white px-4 py-2 flex justify-between">
                <span>Chat with {{ $selectedUser->name }}</span>
                <button wire:click="closeChat" class="text-white text-xl">&times;</button>
            </div>

            <div class="p-3 max-h-96 overflow-y-auto">
                <livewire:chat-box :chatUser="$selectedUser" :key="'chat-'.$selectedUser->id" />
            </div>
        </div>
    @endif
</div>
