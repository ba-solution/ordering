<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class orderingController extends Controller
{
    public function getcustomers(){
        $path = storage_path() . "/app/public/data/customer.json";
        $json = json_decode(file_get_contents($path), true);
        return view('pages.listcustomers')->with("data",$json);

    }
}
