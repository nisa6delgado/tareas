@if(errors())
    <div class="bg-red-100 p-3 mb-4 rounded">
        @foreach(errors() as $error)
            <li>{{ error($error) }}</li>
        @endforeach
    </div>
@endif