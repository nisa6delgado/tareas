<style>
    .csv {
        width: 100%;
    }

    .csv,
    .csv tbody,
    .csv tr,
    .csv th,
    .csv td {
        border: 1px solid black;
        border-collapse: collapse;
        text-align: center;
    }
</style>

<x-filament-panels::page>
    @if($task->description || $task->files)
        <div class="bg-white border rounded shadow-sm p-30" style="padding: 30px">
            @if($task->format == 'checklist')
                {{ checklist($task->description) }}
            @endif

            @if($task->format == 'csv')
                {!! csv($task->description) !!}
            @endif

            @if($task->format == 'code' || $task->format == 'html')
                {!! $task->description !!}
            @endif

            @if($task->format == 'markdown')
                {!! markdown($task->description) !!}
            @endif

            @if($task->files->count())
                <div style="margin-top: 30px">
                    @foreach($task->files as $file)
                        <li>
                            <a href="/download/{{ $file->name }}">
                                {{ $file->name }}
                            </a>
                        </li>
                    @endforeach
                </div>
            @endif
        </div>
    @endif
</x-filament-panels::page>
