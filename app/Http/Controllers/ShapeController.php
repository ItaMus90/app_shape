<?php

namespace App\Http\Controllers;

use App\Shapes;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShapeController extends Controller{


    public function index(){

        return view('start');

    }

    public function create(Request $params){

        $data = $params->all();

        if (!key($data))
            return response()->json(['data'=>"Error121"]);

        for($i = 0; $i < count($data['shapes']); $i++) {

            if (!isset($data['shapes'][$i]["shape_name"]) || !isset($data['shapes'][$i]["params"]) ||  !isset($data['shapes'][$i]["shape_type_name"]) || !isset($data['shapes'][$i]["extent"]))
                return response()->json(['data'=>"Error123123"]);


            $shape_name = $data['shapes'][$i]["shape_name"];
            $params = json_encode($data['shapes'][$i]["params"]);
            $shape_type_name = strtolower($data['shapes'][$i]["shape_type_name"]);
            $extent = floatval($data['shapes'][$i]["extent"]);
            $current_datetime = date('Y-m-d H:i:s');
            $id = md5("as0942@#123456" . microtime() . $shape_name . time());

            try{

                DB::table('shapes')->insert(
                    array(
                        'id' =>  $id,
                        'shape_name'  =>   $shape_name,
                        'shape_type_name' => $shape_type_name,
                        'params' => $params,
                        'extent' => $extent,
                        'created_at' => $current_datetime,
                        'updated_at' => $current_datetime
                    )
                );


                $shape = DB::table('shape_types')->where('shape_type_name', $shape_type_name)->first();

                if($shape === null || !key($shape)){

                    $id = md5("%^%^%^Ffsahdfhas" . microtime() . $shape_type_name . time());

                    DB::table('shape_types')->insert(
                        array(
                            'id' =>  $id,
                            'shape_type_name' => $shape_type_name,
                        )
                    );

                }


            }catch (QueryException $e){

                return response()->json(['data'=>"Error"]);

            }


        }


        return response()->json(['data'=>"Success"]);
    }

    public function update(Request $params){

        $data = $params->all();

        if (!isset($data['shapes'][0]["shape_name"]) || !isset($data['shapes'][0]["params"]) ||  !isset($data['shapes'][0]["shape_type_name"]) || !isset($data['shapes'][0]["extent"]))
            return response()->json(['success'=> $data]);


        $params = json_encode($data['shapes'][0]["params"]);
        $extent = floatval($data['shapes'][0]["extent"]);
        $current_datetime = date('Y-m-d H:i:s');


        try{

            DB::table('shapes')->update(
                array(

                    'params' => $params,
                    'extent' => $extent,
                    'updated_at' => $current_datetime
                )
            );


        }catch (QueryException $e){

            return response()->json(['data'=>"Error"]);

        }


        return true;

    }

    public function getByName(Request $params){

        $data = $params->all();

        if (!isset($data['shapes'][0]["shape_name"]))
            return response()->json(['data'=>"Error"]);

        $shape_name = $data['shapes'][0]["shape_name"];

        try{

            $shape =  DB::table('shapes')->where('shapes_name', '=',$shape_name)->first();

            if (!key($shape))
                return response()->json(['success'=> "Error"]);

        }catch (QueryException $e){

            return response()->json(['data'=>"Error"]);

        }

        return true;
    }

    public function get(){

        $shapes = DB::table('shapes')->get();
        $arr_shapes = array();

        foreach ($shapes as $shape) {

            $arr_shapes[$shape->shape_name] = array(
                "parmas" => $shape->params,
                "extent" => $shape->extent,
                "shape_type" => $shape->shape_type_name,
                "shape_name" => $shape->shape_name
            );

        }


        return ['shapes' => json_encode($arr_shapes)];
    }

    public function delete(Request $params) {

        $data = $params->all();

        if (!isset($data['shapes'][0]["shape_name"]))
            return response()->json(['data'=>"Error"]);

        $shape_name = $data['shapes'][0]["shape_name"];

        try{

            DB::table('shapes')->where('shapes_name', '=',$shape_name)->delete();

        }catch (QueryException $e){

            return response()->json(['data'=>"Error"]);

        }

        return true;

    }

}
