<div class="col-md-12">
    <div class="form-group">
        {{ trans('app.order_back') }}
        {!! Form::checkbox('ride_back', old('ride_back'), old('ride_back') ) !!}
    </div>
</div>