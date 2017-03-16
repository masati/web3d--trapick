<?php

namespace App\Http\Controllers;

use Gate;
use App\Http\Requests;
use Illuminate\Http\Request;

use App\Http\Requests\Step1Request;
use App\Http\Requests\Step2Request;
use App\Http\Requests\Step3Request;
use App\Http\Requests\Step4Request;

use App\Models\Transport;
use App\Models\Cars;
use App\Models\Order;
use App\Models\Route;

class OrderController extends Controller
{

    public function getStep1()
    {
        $data = [
            'step' => 1,
            'routes' => Route::all()->pluck('name', 'id'),
        ];

        return view('order.step1')->with($data);
    }

    public function postStep1(Request $request)
    {
        //dd($request);
        //validate()
        //return back()->withInput();

        return redirect("step2");
    }

    public function getStep2()
    {
        $data = [
            'step' => 2,
            'cars' => Cars::all(),
        ];

        return view('order.step2')->with($data);
    }

    public function postStep2(Request $request)
    {
        return redirect("step3");
    }

    public function getStep3()
    {
        return __METHOD__;
    }
}