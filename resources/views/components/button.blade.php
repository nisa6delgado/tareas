<div class="md:flex md:items-center">
    <div class="md:w-1/3"></div>
    <div class="md:w-2/3">
        <button class="{{ $class }} shadow bg-black hover:bg-black focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4" type="submit">
            {{ isset($text) ? $text : 'Guardar' }}
        </button>
    </div>
</div>
