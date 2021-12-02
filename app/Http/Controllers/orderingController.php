<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class orderingController extends Controller
{
    public function getcustomers(){
        $path = storage_path() . "/app/public/data/customer.json";
        $json = json_decode(file_get_contents($path), true);
        return view('pages.listcustomers')->with("data",$json);

    }
    public function getorders(){
        $path = storage_path() . "/app/public/data/orders.json";
        $json = json_decode(file_get_contents($path), true);
        return view('pages.listorders')->with("data",$json);
    }

    public function vieworder($id){
        $path = storage_path() . "/app/public/data/items.json";
        $json = json_decode(file_get_contents($path), true);
        $data = collect($json)->where("orderId","=",$id)->all();
        return view('pages.vieworder')->with("data",$data)->with('id',$id);
    }
    public function products(){
        $path = storage_path() . "/app/public/data/items.json";
        $json = json_decode(file_get_contents($path), true);
        $data = collect($json)->unique('id');
        return view('pages.listproducts')->with("data",$data);
    }
    public function dashboard(){
        $path = storage_path() . "/app/public/data/customer.json";
        $cust = json_decode(file_get_contents($path), true);
        $customers = count($cust);

        $path1 = storage_path() . "/app/public/data/orders.json";
        $ord = json_decode(file_get_contents($path1), true);
        $orders = count($ord);

        return view('pages.dashboard')->with("orders",$orders)->with("customers",$customers);
    }

    public function filter(Request $request){
        $from = $request['from'];
        $to = $request['to'];
        $less =  $request['less'];
        $great = $request['great'];
        $path = storage_path() . "/app/public/data/orders.json";
        $json = json_decode(file_get_contents($path), true);

        if($from !=null && $to !=null){
            $search = collect($json)->whereBetween('createdAt', [$from, $to])->all();
            return view('pages.listorders')->with("search",$search);
        }
        else if($less !=null) {
            $search = collect($json)->where('createdAt','<=',$less)->all();
            return view('pages.listorders')->with("search",$search);
        }
        else if($great !=null){
            $search = collect($json)->where('createdAt','>=',$great)->all();
            return view('pages.listorders')->with("search",$search);
        }
    }

}
