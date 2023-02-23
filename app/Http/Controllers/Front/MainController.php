<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\City;
use App\Models\DonationRequest;
use App\Models\Governorate;
use App\Models\Post;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        $posts = Post::all();
        $donations = DonationRequest::with('bloodType','city')->take(4)->get();
        return view('front.home', compact('posts','donations'));
    }

    public function whoWeAre(){
        return view('front.who_we_are');
    }

    public function about(){
        return view('front.about');
    }

    public function postDetails($id){
        $post = Post::with('category')->find($id);
        return view('front.post_details',compact('post'));
    }

    public function donations(Request $request){
        $records = DonationRequest::with('bloodType','city')->where(function($q) use($request){
            if($request->blood_type){
                $q->where('blood_type_id',$request->blood_type);
            }
            if($request->city){
                $q->where('city_id', $request->city);
            }
        })->paginate(3);
        $bloodTypes = BloodType::all();
        $cities = City::all();
        return view('front.donation_request',compact('records','bloodTypes','cities'));
    }

    public function contactUs(){
        return view('front.contact-us');
    }
    public function toggleFavourites(Request $request){

        $posts = $request->user()->posts();
        $toggle = $posts->toggle($request->post_id);

    }
    public function myFavourites(){
        $posts = auth('client')->user()->posts;
        return view('front.client_posts_favourties',compact('posts'));
    }
}
