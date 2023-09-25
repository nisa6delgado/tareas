<x-template active="{{ $task->project->slug }}">
    <section class="w-full lg:w-4/5 mb-20 pr-4">
        <!--Title-->
        <x-title icon="{{ $task->project->icon }}" title="{{ $task->title }} » Editar tarea"/>

        <x-validation-errors/>

        <div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white">
            <form enctype="multipart/form-data" method="POST" action="/tasks/update">
                <input type="hidden" name="id" value="{{ $task->id }}">

                <x-input required label="Título" key="title" value="{{ $task->title }}"/>

                <x-select change="reloadWithParams()" required label="Proyecto" key="id_project" value="{{ $task->id_project }}" options="{!! $projects !!}"/>

                <x-select required label="Formato" key="format" value="{{ $task->format }}" options="{!! formats() !!}"/>

                <x-textarea label="Descripción" key="description" value="{!! $task->description !!}"/>
                <x-input-file label="Archivos adjuntos" multiple key="files[]"/>

                <div class="md:flex mb-6">
                    <div class="md:w-1/3"></div>

                    <div class="md:w-2/3">
                        @if($task->files->count())
                            <ul>
                                @foreach($task->files as $file)
                                    <li>
                                        <a x-on:click="confirmDelete(event, $el, 'ajax')" data-tooltip-target="delete" href="{{ '/files/delete/' . $file->id }}">{{ $file->file }}</a>

                                        <x-tooltip text="Eliminar archivo" id="delete"/>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <x-button class="save"/>

                        <x-link
                            id="back"
                            href="/tasks/show/notas/{{ $task->id }}"
                            class="back py-2 px-4"
                            color="gray"
                            icon="fa fa-arrow-left"
                            content="Ir a atrás"
                        />
                    </div>
                </div>
            </form>
        </div>
    </section>

    @if($task->format == 'html' || get('format') == 'html')
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
