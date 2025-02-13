<x-filament-panels::page>
    <div class="bg-white border rounded shadow-sm p-30" style="padding: 30px">
        @if($task->format == 'checklist')
            {{ checklist($task->description) }}
        @endif

        @if($task->format == 'csv')
            {{ csv($task->description) }}
        @endif

        @if($task->format == 'code' || $task->format == 'html')
            {!! $task->description !!}
        @endif

        @if($task->format == 'markdown')
            {!! markdown($task->description ?? '') !!}
        @endif
    </div>
</x-filament-panels::page>
