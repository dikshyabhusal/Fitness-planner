<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Chat with {{ $student->name }}</h1>

    {{-- This must receive a single User model --}}
    <livewire:chat-box :trainer="$student" />
</x-app-layout>
