<div class="md:flex mb-6">
    <div class="md:w-1/3">
        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="{{ $key }}">
            {{ $label }}
        </label>
    </div>
    <div class="md:w-2/3">
        <select {!! isset($change) ? 'x-on:change="reloadWithParams()"' : '' !!} class="form-input block w-full focus:bg-white p-2" name="{{ $key }}" id="{{ $key }}">
            <option value=""></option>

           @foreach(json($options) as $option)
                <option {{ isset($value) && $option->id == $value ? 'selected' : '' }} value="{{ $option->id }}">{{ $option->name }}</option>
            @endforeach
        </select>
    </div>
</div>
