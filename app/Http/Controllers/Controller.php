<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\URL;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function index(){
        $urls = URL::all();
        return view('welcome',['urls'=>$urls]);
    }

    function saveURL(Request $request){
        $og_url = addslashes($request['full_url']);
        $shorten_url = substr(md5(microtime()), rand(0, 26), 5);
        $hidden_url = addslashes($request['hidden_url']);
        if(!empty($shorten_url)){
                $url = new URL();
                $explodeURL = explode('/', $shorten_url);
                $shortURL = end($explodeURL);
                if($shortURL != ""){
                    $url->shorten_url = $shortURL;
                    $url->full_url = $og_url;
                    $url->clicks = 0;
                    if($url->save()){
                        return redirect()->back()->with('message', 'Link added succesfully');   
                    }else{
                        return redirect()->back()->with('message', 'Error adding link');   
                    }
                }else{
                    echo "Required - You have to enter short url!";
                }

        }else{
            echo "Error- You have to enter short url! ". $shorten_url;
        }
    
    }
    function clickLink($shorten_url){

    }
    function deleteURL($id){}
    function deleteAll(){

    }

}
