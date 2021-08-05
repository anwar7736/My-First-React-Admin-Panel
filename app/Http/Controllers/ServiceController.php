<?php
namespace App\Http\Controllers;
use App\Models\ClientReviewModel;
use App\Models\ServiceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    function onSelect(){
        $result= ServiceModel::all();
        return  $result;  
    }

    function ServiceList(){
        $result=ServiceModel::all();
        return $result;
    }

    function ServiceDelete(Request $request){
        $id=$request->input('id');

        $service_logo=ServiceModel::where('id','=',$id)->get(['service_logo']);
        $service_logo_name=explode('/',$service_logo[0]['service_logo'])[6];
        Storage::delete('public/'. $service_logo_name);
        $result=ServiceModel::where('id','=',$id)->delete();
        return $result;
    }
    function AddService(Request $request){
        $title=  $request->input('name');
        $des=  $request->input('desc');
        $PhotoPath=$request->file('photo')->store('public');
        $PhotoName=explode("/", $PhotoPath)[1];
        $PhotoURL="https://".$_SERVER['HTTP_HOST']."/storage/app/public/".$PhotoName;
        $result= ServiceModel::insert(['service_name'=>$title,'service_description'=>$des,'service_logo'=> $PhotoURL]);
        return $result;
    }
}
