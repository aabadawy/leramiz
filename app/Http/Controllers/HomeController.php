<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Property;
use App\Detail;
use App\City;
use App\Kind;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $properties = Property::orderBy('created_at' ,'desc')->get();
        $cities = City::all();
        $kinds = Kind::all();
        return view('index',[
            'properties' => $properties,
            'kinds' => $kinds,
            'cities' => $cities,
        ]);
    }
    public function profile($email)
    {
        
        $user = User::where('email' , $email)->firstOr(function(){
            return abort(404);
        });
        
        $details = Detail::all()->pluck('name' , 'id');
        $citiess = City::all()->pluck('name' , 'name');
        $kinds = Kind::all()->pluck('name' , 'name');
        $users = User::all();
        if(Auth::guest())
        {
                if(Auth::user()->roles->contains('name' , 'client') && Auth::user()->id == $user->$id)
                {
                    return view('guest',[
                        'kinds' => $kinds,
                        'details' => $details,
                        'citiess' => $citiess,
                        'user' => $user,
                    ]);
                }
        }
        else
        {
            return view('guest',[
                'user' => $user ,
            ]);
        }

            
    }
}
