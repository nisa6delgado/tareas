<button class="{{ $class }} shadow bg-black hover:bg-black focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4" type="submit">
    {!! isset($text) ? $text : '<i class="fa fa-save"></i> Guardar' !!}
</button>