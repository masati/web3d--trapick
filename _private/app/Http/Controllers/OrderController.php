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
use App\Models\Ride;
use App\Models\Order;
use App\Models\Route;
use Illuminate\Support\Facades\Input;

class OrderController extends Controller
{

    public function getStep1(Request $request)
    {
        //dump($request->all(), $request->old());
        $data = [
            'step' => 1,
            'routes' => Route::all()->pluck('name', 'id'),
        ];

        return view('order.step1')->with($data);
    }

    public function postStep1(Request $request)
    {
        //dd($request->all(), $request->old());
        //validate()
        //return back()->withInput();
        return redirect("step2")->withInput();
    }

    public function getStep2(Request $request)
    {
        $step1 = $request->old();
        $Transport = Transport::orderBy('capacity')->get();

        $numPassengers = [
            $step1['passengers'][0] + $step1['passengers_baby'][0],
            $step1['passengers'][1] + $step1['passengers_baby'][1]
        ];
        $carType = '';
        if ($numPassengers[0] > $Transport->max('capacity')) {
            $carType[0] = $Transport->where('capacity', null)->lists('id')[0];
        }
        if ($numPassengers[1] > $Transport->max('capacity')) {
            $carType[1] = $Transport->where('capacity', null)->lists('id')[0];
        }

        foreach ($Transport as $car) {
            if (isset($carType[0])) {
                break;
            }
            if (!isset($carType[0]) and $numPassengers[0] > $car->capacity) {
                continue;
            }
            if ($numPassengers[0] <= $car->capacity) {
                $carType[0] = $car->id;
                break;
            }
        }
        foreach ($Transport as $car) {
            if (isset($carType[1])) {
                break;
            }
            if (!isset($carType[1]) and $numPassengers[1] > $car->capacity) {
                continue;
            }
            if ($numPassengers[1] <= $car->capacity) {
                $carType[1] = $car->id;
                break;
            }
        }

        $data = [
            'step' => 2,
            'cars' => $Transport,
            'car_type' => $carType,
            'num_pass' => $numPassengers
        ];
        return view('order.step2')->with($data);
    }

    public function postStep2(Request $request)
    {
        if ($request->get('back')) return redirect("step1")->withInput();
        return redirect("step3")->withInput();
    }

    public function getStep3(Request $request)
    {
        //dump($request->all(), $request->old());
        $input = $request->old();
        $data = [];
       foreach($input as $key => $value) {

           if ($key == '_token') continue;
           if ((is_array($value))) {
               foreach ($value as $d => $item) {
                   if ($key == 'passengers_total') {
                        $data[$d]['passengers_total'] = $input['passengers_total'][$d][$input['car_type'][$d]];
                   }
                   else {
                       $data[$d][$key] = $value[$d];
                   }
               }
           }
           else {
               $data[$key] = $value;
           }
        }
       $order = new Order;
       $order = $order->create([
           'user_id' => 1, 'transport_id' => $data[0]['car_type'], 'transport_back_id' => isset($data['ride_back']) ? $data[1]['car_type'] : null]);
        $rides[] = $order->rides()->create([
            'pick_date' => $data[0]['pick_date'],
            'pick_time' => $data[0]['pick_time'],
            'route_from' => $data[0]['route_from'],
            'route_to' => $data[0]['route_to']
        ]);
       if (isset($data['ride_back'])) {
           $rides[] = $order->rides()->create([
               'pick_date' => $data[1]['pick_date'],
               'pick_time' => $data[1]['pick_time'],
               'route_from' => $data[1]['route_from'],
               'route_to' => $data[1]['route_to']
           ]);
       }

        //$rides = new Ride;
        return redirect('orders/' . $order->id);
    }

    public function getOrders($id)
    {
        return view('order.step3', ['order' => Order::find($id), 'rides' => Ride::where('order_id', $id)->get(), 'step' => 3]);
    }
}