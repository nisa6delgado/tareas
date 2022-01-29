<h1 class="flex justify-between items-center font-sans font-bold break-normal text-gray-700 px-2 text-xl mt-12 lg:mt-0 md:text-2xl">
    <div>
        <i class="{{ $icon }} mr-5"></i> {{ $title }}
    </div>

    @if(isset($buttons))
        {{ $buttons }}
    @endif
</h1>
