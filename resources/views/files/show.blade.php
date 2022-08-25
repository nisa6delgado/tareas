<x-template active="{{ $file->task->project->slug }}">
    <section class="w-full lg:w-4/5 mb-20">
        <!--Title-->
        <x-title icon="{{ $file->icon }}" title="{{ $file->file }}">
            <x-slot name="buttons">
                <x-link
                        href="{{ '/files/download/' . $file->id }}"
                        title="Descargar archivo"
                        color="gray"
                        icon="fa fa-download"
                        id="download"
                        class="download"
                    />
            </x-slot>
        </x-title>

        <hr class="bg-gray-300 my-6">

        <div class="p-8 mt-6 m-1 lg:mt-0 leading-normal rounded shadow bg-white text-center">
            {!! $file->content !!}
        </div>
    </section>
</x-template>
