<div>
    @if ($message['role'] === 'user')
    <div class="flex justify-end">
        <div class="bg-blue-500 text-white px-4 py-2 rounded-2xl max-w-lg shadow-sm text-sm relative">
            {{ $message['content'] }}
            <div class="text-[10px] text-white/70 mt-1 text-right">
                {{ \Carbon\Carbon::parse($message['timestamp'])->format('H:i') }}
            </div>
        </div>
    </div>
    @elseif ($message['role'] === 'assistant')
    <div class="flex justify-start">
        <div class="bg-indigo-50 text-gray-800 px-4 py-2 rounded-2xl max-w-lg shadow-sm text-sm relative">
            {{ $message['content'] }}
            <div class="text-[10px] text-gray-500 mt-1 text-left">
                {{ \Carbon\Carbon::parse($message['timestamp'])->format('H:i') }}
            </div>
        </div>
    </div>
    @endif
</div>