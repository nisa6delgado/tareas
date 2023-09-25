<x-template active="{{ $task->project->slug }}">
    <section class="w-full lg:w-4/5 mb-10 pr-4">
        <!--Title-->
        <x-title icon="{{ $task->project->icon }}" title="{{ $task->title }}">
            <x-slot name="buttons">
                <div class="flex items-center ml-1">
                    <x-link
                        href="{{ '/projects/show/' . $task->project->slug }}"
                        title="Ir a atrás"
                        color="gray"
                        icon="fa fa-arrow-left"
                        id="back"
                        class="back"
                    />

                    <x-link
                        href="{{ '/tasks/edit/' . $task->project->slug . '/' . $task->id }}"
                        title="Editar esta tarea"
                        color="gray"
                        icon="fa fa-edit"
                        id="edit"
                        class="edit"
                    />

                    <x-link
                        href="{{ '/tasks/delete/' . $task->project->slug . '/' . $task->id }}"
                        title="Eliminar esta tarea"
                        color="red"
                        icon="fa fa-trash"
                        delete="true"
                        id="delete"
                        class="delete"
                    />
                </div>
            </x-slot>
        </x-title>

        @if($task->description)
            <div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white">
                @if($task->format == 'checklist')
                    {!! checklist($task->description) !!}
                @endif
                
                @if($task->format == 'code')
                    <code>
                        <pre>
                            {!! $task->description !!}
                        </pre>
                    </code>
                @endif

                @if($task->format == 'csv')
                    {!! csv($task->description) !!}
                @endif

                @if($task->format == 'html')
                    {!! $task->description !!}
                @endif

                @if($task->format == 'markdown')
                    {!! markdown($task->description) !!}
                @endif
            </div>
        @else
            <div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white text-center">No hay descripción</div>
        @endif

        @if($task->files->count())
            <div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white">
                <p><b>Archivos adjuntos</b></p>

                @foreach($task->files as $file)
                    <span class="mr-2">
                        <a href="{{ $file->url }}">
                            <i class="{{ $file->icon }}"></i> {{ $file->file }}
                        </a>
                    </span>
                @endforeach
            </div>
        @endif
    </section>

    @if($task->format == 'html')
        <x-slot:js>
            <script src="{{ node('tinymce/tinymce.js') }}"></script>

            <script>
                tinymce.init({
                    selector: 'textarea',
                    plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                    tinycomments_mode: 'embedded',
                    tinycomments_author: 'Author name',
                    mergetags_list: [
                        { value: 'First.Name', title: 'First Name' },
                        { value: 'Email', title: 'Email' },
                    ],
                    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant"))
                });
            </script>
        </x-slot:js>
    @endif
</x-template>
