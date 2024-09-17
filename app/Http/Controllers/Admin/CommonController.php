<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\City;
use App\Models\Admin;
use App\Models\Client;
use App\Models\JobType;
use App\Models\Product;
use App\Models\District;
use App\Models\PlateStock;
use App\Models\ClientPlate;
use Illuminate\Http\Request;
use App\Models\ClientProduct;
use App\Models\MaterialInwardItem;
use App\Http\Controllers\Controller;

class CommonController extends Controller{


    public function productSingle(Request $request){
        if ($request->ajax()) {
            $results = Product::where('id', $request->id)->with(['unit'])->first();
            return response()->json(['datas'=>$results, 'error'=>false]);
        }
        return response()->json('oops');
    }


    public function productList(Request $request){
        if ($request->ajax()) {
            $page = $request->page;
            $resultCount = 15;

            $offset = ($page - 1) * $resultCount;

            $name = Product::orderBy('name', 'asc')->where('name', 'LIKE', '%' . $request->term. '%')
                                    ->orderBy('created_at', 'asc')
                                    ->skip($offset)
                                    ->take($resultCount)
                                    ->selectRaw('id, name as text')
                                    ->get();

            $count = Count(Product::orderBy('name', 'asc')->where('name', 'LIKE', '%' . $request->term. '%')
                                    ->orderBy('created_at', 'asc')
                                    ->selectRaw('id, name as text')
                                    ->get());

            $endCount = $offset + $resultCount;
            $morePages = $count > $endCount;

            $results = array(
                  "results" => $name,
                  "pagination" => array(
                      "more" => $morePages
                  )
              );

            return response()->json($results);
        }
        return response()->json('oops');
    }


    public function clientProductList(Request $request){
        if ($request->ajax()) {
            $page = $request->page;
            $resultCount = 15;
            $offset = ($page - 1) * $resultCount;

            $clent = Admin::find($request->client);
            if($clent->role_id == 5){
                $name = ClientProduct::orderBy('name', 'asc')->where('name', 'LIKE', '%' . $request->term. '%')
                                        ->orderBy('created_at', 'asc')
                                        ->skip($offset)
                                        ->take($resultCount)
                                        ->selectRaw('id, name as text')
                                        ->get();

                $count = Count(ClientProduct::orderBy('name', 'asc')->where('name', 'LIKE', '%' . $request->term. '%')
                                    ->orderBy('created_at', 'asc')
                                    ->selectRaw('id, name as text')
                                    ->get());
            } else{
                $name = ClientProduct::orderBy('name', 'asc')->where('name', 'LIKE', '%' . $request->term. '%')
                                        ->where('client_id', $request->client)
                                        ->orderBy('created_at', 'asc')
                                        ->skip($offset)
                                        ->take($resultCount)
                                        ->selectRaw('id, name as text')
                                        ->get();

                $count = Count(ClientProduct::orderBy('name', 'asc')->where('name', 'LIKE', '%' . $request->term. '%')
                                    ->where('client_id', $request->client)
                                    ->orderBy('created_at', 'asc')
                                    ->selectRaw('id, name as text')
                                    ->get());
            }



            $endCount = $offset + $resultCount;
            $morePages = $count > $endCount;

            $results = array(
                  "results" => $name,
                  "pagination" => array(
                      "more" => $morePages
                  )
              );

            return response()->json($results);
        }
        return response()->json('oops');
    }


    public function client(Request $request){
        if ($request->ajax()) {
            $page = $request->page;
            $resultCount = 15;

            $offset = ($page - 1) * $resultCount;

            $name = Client::orderBy('company_name', 'asc')->where('company_name', 'LIKE', '%' . $request->term. '%')
                                    ->orderBy('created_at', 'asc')
                                    ->skip($offset)
                                    ->take($resultCount)
                                    ->selectRaw('id, company_name as text')
                                    ->get();

            $count = Count(Client::orderBy('company_name', 'asc')->where('company_name', 'LIKE', '%' . $request->term. '%')
                                    ->orderBy('created_at', 'asc')
                                    ->selectRaw('id, company_name as text')
                                    ->get());

            $endCount = $offset + $resultCount;
            $morePages = $count > $endCount;

            $results = array(
                  "results" => $name,
                  "pagination" => array(
                      "more" => $morePages
                  )
              );

            return response()->json($results);
        }
        return response()->json('oops');
    }




    public function downloadFile($filename)
    {
        $filePath = storage_path('app/' . $filename);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            abort(404, 'File not found');
        }
    }


    public function cityList(Request $request, $stateID){
        if ($request->ajax()) {
            $page = $request->page;
            $resultCount = 15;

            $offset = ($page - 1) * $resultCount;

            $name = City::where('name', 'LIKE', '%' . $request->term . '%')
                    ->where('district_id', $stateID)
                    ->orderBy('name', 'asc')
                    ->skip($offset)
                    ->take($resultCount)
                    ->selectRaw('id, name as text')
                    ->get();

            $count = City::where('name', 'LIKE', '%' . $request->term . '%')
                    ->where('district_id', $stateID)
                    ->orderBy('name', 'asc')
                    ->selectRaw('id, name as text')
                    ->count();
            $endCount = $offset + $resultCount;
            $morePages = $count > $endCount;

            $results = [
                "results" => $name,
                "pagination" => [
                    "more" => $morePages
                ]
            ];

            return response()->json($results);
        }

        return response()->json('oops');
    }



    public function districtList(Request $request, $stateID){
        if ($request->ajax()) {
            $page = $request->page;
            $resultCount = 15;

            $offset = ($page - 1) * $resultCount;

            $name = District::where('name', 'LIKE', '%' . $request->term . '%')
                    ->where('state_id', $stateID)
                    ->orderBy('name', 'asc')
                    ->skip($offset)
                    ->take($resultCount)
                    ->selectRaw('id, name as text')
                    ->get();

            $count = District::where('name', 'LIKE', '%' . $request->term . '%')
                    ->where('state_id', $stateID)
                    ->orderBy('name', 'asc')
                    ->selectRaw('id, name as text')
                    ->count();
            $endCount = $offset + $resultCount;
            $morePages = $count > $endCount;

            $results = [
                "results" => $name,
                "pagination" => [
                    "more" => $morePages
                ]
            ];

            return response()->json($results);
        }

        return response()->json('oops');
    }



}
