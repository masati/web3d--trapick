<div class="col-md-4">
    <div class="row">
        {{ trans('app.' . $car->name) }}
        <i class="fa fa-{{ $car->image }}" aria-hidden="true"></i>
        {!! Form::radio('car_type[' . $direction . ']', $car->id, (($car_type[$direction] == $car->id) ? true : false ), ['data-direction' => $direction, 'class' => 'car_type'])  !!}
    </div>
    <div class="row">
        {{ trans('app.passengers_total') }}
        @if ($car_type[$direction] == $car->id)
            <input type="number" size="3" data-car={{ $car->id}} data-direction={{ $direction }} name="passengers_total[{{ $direction }}][{{ $car->id }}]" min="0" max="{{ (is_null($car->capacity) ? 100 : $car->capacity) }}" value="{{ $num_pass[$direction] }}">
        @else
            <input type="number" size="3" data-car={{ $car->id}} data-direction={{ $direction }} name="passengers_total[{{ $direction }}][{{ $car->id }}]" min="0" max="{{ (is_null($car->capacity) ? 100 : $car->capacity) }}" value="0">
        @endif
    </div>
    <div class="row">
        {{ trans('app.bags') }}
        {{ $car->bags }}
    </div>
</div>