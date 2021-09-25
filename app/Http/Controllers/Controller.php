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

    function generateShortenedURL($url){//Function to genereate a shortened url ending
        $shortened_url = substr(md5(microtime()), rand(0, 26), 5);
        $url_exists = URL::where('shorten_url', $shortened_url)->exists(); //Chekc
        if($url_exists){
            generateShortenedURL($url);
        }else{
            return $shortened_url;
        }
    }

    function saveURL(Request $request){
        $og_url = addslashes($request['full_url']);
        $shorten_url = $this->generateShortenedURL($og_url);
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
                    echo "Required - You have to enter short url. It cannot be left blank!";
                }

        }else{
            echo "Error - You have to enter short url! ". $shorten_url;
        }
    
    }
    function clickLink($shorten_url){
        $url = URL::where('shorten_url',$shorten_url)->first();
        $redirect_url = $url->full_url;
        echo $redirect_url;
        $url->clicks = $url->clicks + 1;  
        if($url->update()){
           return  redirect()->to($redirect_url);
        }
    }
    function deleteURL($id){
        $url = URL::find($id);
        if($url->delete()){
            return redirect()->back();
        }else{
            return redirect()->back();
        }
    }
    function topURLs(){
        $urls = URL::orderBy('clicks','desc')->take(100)->get();//Retrieve only top 100 URLS
        return view('top',['urls'=>$urls]);
    }

}
