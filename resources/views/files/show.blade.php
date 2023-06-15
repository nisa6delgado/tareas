<x-template active="{{ $file->task->project->slug }}">
    <section class="w-full lg:w-4/5 mb-20">
        <!--Title-->
        <x-title icon="{{ $file->icon }}" title="{{ $file->file }}">
            <x-slot name="buttons">
                <div class="flex items-center">
                    <x-link
                        href="{{ '/tasks/show/otros/' . $file->task->id }}"
                        title="Ir a atrás"
                        color="gray"
                        icon="fa fa-arrow-left"
                        id="back"
                        class="back"
                    />

                    <x-link
                        href="{{ '/files/show/' . $file->id . '?download=1' }}"
                        title="Descargar archivo"
                        color="gray"
                        icon="fa fa-download"
                        id="download"
                        class="download"
                    />

                    <x-link
                        href="{{ '/files/delete/' . $file->id . '?redirect=1' }}"
                        title="Eliminar este archivo"
                        color="red"
                        icon="fa fa-trash"
                        delete="true"
                        id="delete"
                        class="delete"
                    />                    
                </div>
            </x-slot>
        </x-title>

        <hr class="bg-gray-300 my-6">

        <div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white text-center">
            {!! $file->content !!}
        </div>
    </section>
</x-template>
