<?php

namespace App\Http\Requests;

use Gate;
use App\Http\Requests\Request;

class Step1Request extends Request {

    public function authorize()
    {
        return true; //Gate::allows('step1');
    }

    public function rules()
    {
        return [
            'route_from' => 'required|integer|exists:mysql.route,id',
            'route_to' => 'required|integer|exists:mysql.route,id',
            'pick_date' => 'required|date',
            'pick_time' => 'required|date',
            'passengers' => 'required|integer|min:1',
            'passengers_baby' => 'integer|min:0',
        ];
    }
}