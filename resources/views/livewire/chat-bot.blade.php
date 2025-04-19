<div class="max-w-3xl mx-auto p-6 bg-white shadow-xl rounded-2xl mt-10 flex flex-col h-[80vh] border border-gray-200">
    <h2 class="text-3xl font-semibold mb-2 text-blue-600 flex items-center gap-2">🧠 AI Psikolog Virtual</h2>
    <p class="text-gray-600 mb-4">Ceritakan apa pun yang kamu rasakan hari ini. Aku di sini untuk mendengarkan 😊</p>

    {{-- Chat History --}}
    <div id="chatContainer"
        class="flex-1 overflow-y-auto space-y-3 mb-4 px-2 pr-4 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-transparent">

        @foreach ($chatHistory as $index => $message)
        @livewire('chat-message', ['message' => $message], key($index . $message['role']))
        @endforeach

    </div>

    {{-- Input Form --}}
    <form wire:submit.prevent="submit" class="mt-2 space-y-2">
        <textarea wire:model.defer="prompt" required rows="3" placeholder="Tulis curhatanmu di sini..." class="w-full p-4 border border-gray-300 rounded-xl resize-none transition-all text-sm
            focus:outline-none focus:ring-2 focus:ring-blue-400
            @error('prompt') ring-2 ring-red-500 animate-shake @enderror"></textarea>

        @error('prompt')
        <div class="text-sm text-red-500 mt-1">{{ $message }}</div>
        @enderror

        <div class="flex justify-end items-center">
            <button type="submit"
                class="inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-5 py-2.5 rounded-xl transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                wire:loading.attr="disabled">
                <svg wire:loading class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z" />
                </svg>
                <span wire:loading.remove>Kirim</span>
                <span wire:loading> Mengirim... </span>
            </button>
        </div>
    </form>


</div>

{{-- Auto Scroll to Bottom --}}
<script>
    document.addEventListener('livewire:load', function () {
    Livewire.hook('message.processed', () => {
        const chatContainer = document.getElementById('chatContainer');
        if (chatContainer) {
            setTimeout(() => {
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }, 100); // Sedikit delay setelah update DOM
        }
    });

    // Menambahkan observer untuk memastikan pembaruan UI
    Livewire.on('chatUpdated', () => {
        const chatContainer = document.getElementById('chatContainer');
        if (chatContainer) {
            setTimeout(() => {
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }, 100);
        }
    });
});
</script>