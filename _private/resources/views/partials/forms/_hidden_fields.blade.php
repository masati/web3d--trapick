@foreach(old() as $key => $item)
    @if($key == '_token') @continue
    @elseif(is_array($item))
        @foreach($item as $k => $value)
            {!! Form::hidden($key . '[' . $k . ']', $value ) !!}
        @endforeach
    @else
        {!! Form::hidden($key, $item ) !!}
    @endif
@endforeach