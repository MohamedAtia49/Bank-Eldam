<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BloodType;
use App\Models\Category;
use App\Models\City;
use App\Models\Governorate;
use App\Models\Post;
use App\Models\Token;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function posts (Request $request){
        $posts = Post::where(function ($q) use ($request) {
            if($request->has('category_id')){
                $q->where('category_id', $request->category_id);
            }
        })->get();

        return responseJson(1, 'success', $posts);
    }

    public function postDetails(Request $request){
        $validation = Validator()->make($request->all(),[
            'post_id' => 'required|exists:posts,id',
        ]);

        if($validation->fails()){
            return responseJson(0, $validation->errors()->first(), $validation->errors());
        }

        $post = Post::where('id', $request->post_id)->get();
        return responseJson(1, 'success', $post);
    }

    public function search(Request $request){
        $validation = Validator()->make($request->all(),[
            'search' => 'required',
        ]);

            if($validation->fails()){
            return responseJson(0, $validation->errors()->first(), $validation->errors());
            }

            $post = Post::where('title', 'LIKE', "%{$request->search}%")->orWhere('content', 'LIKE', "%{$request->search}%")->get();

            return responseJson(1,'U Searched about',$post);
    }

    public function governorates(){
        $governorates = Governorate::all();
        return responseJson(1,'success',$governorates);
    }

    public function cities(Request $request){
        $cities = City::with('governorate')->where(function($q) use($request){
            if($request->governorate_id){
                $q->where('governorate_id',$request->governorate_id);
            }
        })->get();
        return responseJson(1, 'success', $cities);
    }

    public function categories(){
        $categories = Category::all();
        return responseJson(1, 'success', $categories);
    }

    public function bloodTypes(){
        $bloodTypes = BloodType::all();
        return responseJson(1, 'success', $bloodTypes);
    }

    public function postFavorites(Request $request){
        $validation = Validator()->make($request->all(),[
            'post_id' => 'required|exists:posts,id',
        ] );

        if($validation->fails()){
            return responseJson(0,$validation->errors()->first(),$validation->errors());
        }

        $posts = $request->user()->posts();
        $toggle = $posts->toggle($request->post_id);
        if($toggle){
            return responseJson(1, 'success', $toggle);
        }else{
            return responseJson(0, 'حدث خطا');
        }
    }

    public function myFavorites(Request $request){
        $user = $request->user();
        $posts = $user->posts()->paginate();
        if($posts->count() > 0){
            return responseJson(1, 'Favorite Posts', $posts);
        }else{
            return responseJson(0, 'Account has not Favorites');

        }
    }

    public function donationRequestCreate(Request $request){
        $validation = validator()->make($request->all(),[
            'patient_name' => 'required',
            'patient_age' => 'required',
            'blood_type_id' => 'required|exists:blood_types,id',
            'bags_num' => 'required',
            'hospital_address' => 'required',
            'city_id' => 'required|exists:cities,id',
            'patient_phone' => 'required',
            'email' => 'required|exists:clients,email',
        ]);

        if($validation->fails()){
            return responseJson(0, $validation->errors()->first(), $validation->errors());
        }

        //create donation request
        $donationRequest = $request->user()->donationRequests()->create($request->all());



        //find people near to this request
        $clientsIds = $donationRequest->city->governorate->clients()->whereHas('bloodTypes', function ($q) use ($request) {
            $q->where('blood_types.id', $request->blood_type_id);
        })->pluck('clients.id')->toArray();


        if(count($clientsIds)){
            //create notification on DB
            $notification = $donationRequest->notifications()->create([
                'title' => 'يوجد حالة تبرع قريبة منك',
                'content' => $donationRequest->bloodType->name .'احتاج الى متبرع فصيلة',
            ]);

            //attach clients to this notification
            $notification->clients()->attach($clientsIds);

            $tokens = Token::whereIn('client_id', $clientsIds)->where('token','!=',null)->pluck('token')->toArray();

            return responseJson(1, 'Request Sended');
            // dd($tokens);

            //get token from FCM (push notification using firebase cloud)

        }

    // $clients = Client::whereHas('governorates',function($query)  use($donation){
    //     $query->where('governorate_id',$donation->city->governorate_id);
    // })->whereHas('bloodTypes',function($query) use($donation){
    //     $query->where('blood_type_id',$donation->blood_type_id);
    // })->pluck('id')->toArray();

    // $tokens = Token::whereHas('client',function($query) use($donation){
    //     $query->whereHas('governorates',function($query)  use($donation){
    //         $query->where('governorate_id',$donation->city->governorate_id);
    // })->whereHas('bloodTypes',function($query) use($donation){
    //     $query->where('blood_type_id',$donation->blood_type_id);
    // });
    // })->pluck('fcm_token')->whereNotNull('fcm_token')->toArray();

        }

}
