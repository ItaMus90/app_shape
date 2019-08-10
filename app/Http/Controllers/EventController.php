<?php

namespace App\Http\Controllers;

use App\Shapes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller{

    public function index(){



    }

    public function getEvents(){


    }

    public function getEvent(){

        $shapes = DB::table('shapes')->get();
        $arr_shapes = array();

        foreach ($shapes as $shape) {

            $arr_shapes[$shape->shape_name] = array(
                "parmas" => $shape->params,
                "extent" => $shape->extent
            );

        }


        return view('shapes', ['shapes' => json_encode($arr_shapes)]);

    }

    public function setEvent(Request $params){

        $data = $params->all();
        $is_correct = false;
        $guess = 0;

        if (!isset($data["guess"]) || !isset($data["shape_name"]) || !isset($data["extent"]))
            return response()->json(['success'=> "Error"]);

       if (!is_numeric($data["guess"]))
           return response()->json(['success'=> "Invalid input"]);



        $shape = DB::table('shapes')->where('shape_name', $data["shape_name"])->first();

        if (!key($shape))
            return response()->json(['success'=> "Error"]);

        $guess = floatval($data["guess"]);

        if ($shape->extent === $guess){

            $data = "Correct";
            $is_correct = true;

        }else{

            $data = "Wrong";
            $is_correct = false;

        }

        $current_datetime = date('Y-m-d H:i:s');

        DB::table('results')->insert(
            array(
                'id' =>  md5("as0942@#" . microtime() . $shape->shape_name),
                'shape_name'  =>   $shape->shape_name,
                'is_correct' => $is_correct,
                'guess' => $guess,
                'created_at' => $current_datetime,
                'updated_at' => $current_datetime
            )
        );


        return response()->json(['success'=>$data]);

    }
}

