<?php

namespace App\Http\Controllers;

use App\CSV;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CSVController extends Controller
{
    public function createAppData(Request $request)
    {
        Log::debug('Entrada en el método de crear un registro del csv');
        $response = array('code' => 400, 'error_msg' => []);
        if (isset($request)) {
            Log::debug('Request recibido');
            if (!$request->Date){
                Log::debug('Date is required');
                array_push($response['error_msg'], 'Date is required');
            } 
            if (!$request->App){
                Log::debug('App is required');
                array_push($response['error_msg'], 'App is required');
            } 
            if (!$request->Event){
                Log::debug('Event is required');
                array_push($response['error_msg'], 'Event is required');
            } 
            if (!$request->Latitude){
                Log::debug('Latitude is required');
                array_push($response['error_msg'], 'Latitude is required');
            } 
            if (!$request->Longitude){
                Log::debug('Longutide is required');
                array_push($response['error_msg'], 'Longutide is required');
            } 

            if (!count($response['error_msg']) > 0) {
               // $csv = CSV::where('App', '=', $request->App);
               Log::debug('Datos recibidos');
                    try {
                        $csv = new CSV();
                        $csv->Date = $request->Date;
                        $csv->App = $request->App;
                        $csv->Event = $request->Event;
                        $csv->Latitude = $request->Latitude;
                        $csv->Longutide = $request->Longitude;
                        $csv->save();
                        Log::debug('CSV creado');
                        $response = array('code' => 200, 'user' => $csv, 'msg' => 'User created');
                    } catch (\Exception $exception) {
                        $response = array('code' => 500, 'error_msg' => $exception->getMessage());
                    }
                }
            
        } else {
            $response['error_msg'] = 'Nothing to create';
        }
        return response()->json($response);
    }
}