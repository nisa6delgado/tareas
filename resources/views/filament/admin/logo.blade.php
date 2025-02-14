<table>
    <tr>
        @if($logo)
            <td>
                <img width="30px" src="{{ $logo }}" alt="{{ config('app.name') }}">
            </td>
        @endif

        <td>
            <b style="{{ $logo ? 'margin-left: 10px' : '' }}">{{ config('app.name') }}</b>
        </td>
    </tr>
</table>