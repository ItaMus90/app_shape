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

        if (!isset($data['shapes'][0]["shape_name"]) || !isset($data['shapes'][0]["params"]) ||  !isset($data['shapes'][0]["shape_type_name"]) || !isset($data['shapes'][0]["extent"]))
            return response()->json(['success'=> $data]);


        $shape_name = $data['shapes'][0]["shape_name"];
        $params = json_encode($data['shapes'][0]["params"]);
        $shape_type_name = $data['shapes'][0]["shape_type_name"];
        $extent = floatval($data['shapes'][0]["extent"]);
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

        }catch (QueryException $e){

            return response()->json(['data'=>"Error"]);

        }


        return response()->json(['data'=>"Success"]);
    }

    public function update($params){

    }

    public function getByName($params){

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

}
