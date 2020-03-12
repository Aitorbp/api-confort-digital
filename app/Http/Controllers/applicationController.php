<?php

namespace App\Http\Controllers;
use App\Application;
use Illuminate\Http\Request;

class applicationController extends Controller
{
    public function getAllApplications()
    {
        $application = new Application();
        $applications = $application->getApplications();
        if(isset($applications)){
           
            return response()->json($applications, 201);
        }else{
            return response()->json(["Error" => "No hay aplicaciones guardadas"]);
        }
    }
}
