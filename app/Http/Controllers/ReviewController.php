<?php

namespace App\Http\Controllers;

use App\Models\ClientReviewModel;
use App\Models\ContactTableModel;
use Illuminate\Http\Request;
use Storage, DB;


class ReviewController extends Controller
{
    function ReviewList(){
        $result=ClientReviewModel::all();
        return $result;
    }
    function ReviewDelete(Request $request){
        $id=$request->input('id');

        $client_img=ClientReviewModel::where('id',$id)->get();
        $client_img_name=explode('/',$client_img[0]['client_img'])[6];
        Storage::delete('public/'.$client_img_name);
        $result=ClientReviewModel::where('id',$id)->delete();
        return $result;
    }

    function AddReview(Request $request){
        $title=  $request->input('title');
        $des=  $request->input('desc');
        $PhotoPath=$request->file('photo')->store('public');
        $PhotoName=explode("/", $PhotoPath)[1];

        $PhotoURL="https://".$_SERVER['HTTP_HOST']."/storage/app/public/".$PhotoName;
        $result= ClientReviewModel::insert(['client_img'=> $PhotoURL,'client_title'=>$title,'client_description'=>$des]);
        return $result;
    }


}
