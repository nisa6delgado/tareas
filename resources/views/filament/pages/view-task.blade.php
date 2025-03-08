<x-filament-panels::page>
    @if($task->description || $task->files)
        <div class="description-task bg-white rounded shadow-sm p-30 dark:bg-gray-900">
            @if($task->format == 'checklist')
                {!! checklist($task->description) !!}
            @endif

            @if($task->format == 'csv')
                {!! csv($task->description) !!}
            @endif

            @if($task->format == 'code' || $task->format == 'html')
                {!! $task->description !!}
            @endif

            @if($task->format == 'markdown')
                <div class="markdown">
                    {!! markdown($task->description ?? '') !!}
                </div>
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
