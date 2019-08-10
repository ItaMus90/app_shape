<?php

namespace App\Http\Controllers;

use App\Shapes;
use Illuminate\Http\Request;

class ShapeController extends Controller{


    public function index(){

        $shape = Shapes::all();
        dd($shape);

    }

    public function create($params){

    }

    public function update($params){

    }

    public function getByName($params){

    }

    public function get(){


    }
}
