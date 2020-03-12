<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restriction;
use App\Application;
use App\user;
class restrictionController extends Controller
{
    public function createRestriction(Request $request)
    {
        $restriction = new Restriction();
        $application = Application::where('name',$request->name)->first();
        if (isset($application)) {    
            $email = $request->email;
            $user = User::where('email',$email)->first();
            if (isset($user)) {
                if (is_null($request->max_time)) {
                    if (is_null($request->start_hour_restriction) || is_null($request->finish_hour_restriction)) {
                        return response()->json(["Error" => "Debe de haber alguna restriction"]);
                    }else{     
                        $restriction->new_Restriction($request, $user->id, $application->id);
                        return response()->json(["Success" => "Se ha añadido la restriction"]);
                    }
                }else{
                    $restriction->new_Restriction($request,$user->id, $application->id);
                    return response()->json(["Success" => "Se ha añadido la restriction"]);
                }
            }else{
                return response()->json(["Error" => "El usuario no existe"]);
            }
        }else{
            return response()->json(["Error" => "La aplicacion no existe"]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRestriction(Request $request)
    {
        $email = $request->email;
        $user = User::where('email',$email)->first();
        $restrictions = Restriction::where('user_id',$user->id)->get();
        if (isset($restrictions)) {
            
            return response()->json(["Success" => $restrictions]);   
        }else{
          
            return response()->json(["Error" => "Debe de haber alguna restriction"]);    
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRestriction(Request $request)
    {
        $restriction = Restriction::where('id',$request->id)->first();
        if (isset($restriction)) {
            if(is_null($request->max_time)){
                if (is_null($request->start_hour_restriction) || is_null($request->finish_hour_restriction)) {
                    return response()->json(["Error" => "La restriccion no existe"]);
                }else{
                    $restriction->start_hour_restriction = $request->start_hour_restriction;
                    $restriction->finish_hour_restriction = $request->finish_hour_restriction;
                    $restriction->update();
                   return response()->json(["Success" => "Se ha modificado la restriccion."]);
                } 
            }else{
                $restriction->max_time = $request->max_time;
                $restriction->update();
                return response()->json(["Success" => "Se ha modificado la restriccion."]);
            }
            return response()->json(["Success" => "Se ha modificado la restriccion."]);
        }else{
            return response()->json(["Error" => "La restriccion no existe"]);
        } 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteRestriction(Request $request)
    {
        $restriction = Restriction::where('id',$request->id)->first();
         if (isset($restriction)) {
            $restriction->delete();
            return response()->json(["Success" => "Se ha modificado la restriccion."]);
            
        }else{
            return response()->json(["Error" => "La restriccion no existe"]);
        }
    }
}
