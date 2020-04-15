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
        $id = Null ;
        $details = Detail::all()->pluck('name' , 'id');
        $citiess = City::all()->pluck('name' , 'name');
        $kinds = Kind::all()->pluck('name' , 'name');
        $users = User::all();


        foreach ($users as $user) {
            if($user->email === $email)
                $id = $user->id;
        }
        
        $allKindProp = Property::all()->get('kind');
        $allRentSaleProp = Property::all()->get('rent_sale');
        $relatedProperty = Property::all()->where([
            'kind' => $allKindProp,
            'rent_sale' => $allRentSaleProp,
        ]);
        $user = User::findOrFail($id);
        if(Auth::user()->roles->contains('name' , 'client') && Auth::user()->id == $id)
        {
            return view('guest',[
                'kinds' => $kinds,
                'details' => $details,
                'citiess' => $citiess,
                'user' => $user,
                'relatedProperty' => $relatedProperty,
            ]);
        }
        else
        {
            return view('guest',[
                'user' => $user ,
                'relatedProperty' => $relatedProperty,
            ]);
        }

        // if(!Auth::guest()){
        //     if(Auth::user()->id == $id)
        //     {
        //         return view('agent',[
        //             'details' => $details,
        //             'citiess' => $citiess,
        //             'cities' => $cities,
        //             'kinds' => $kinds,
        //             'user' => $user,
        //         ]);
        //     }
        //     else{
        //         return view('guest',[
        //             'user' => $user ,
        //             'properties' => $user->properties,
        //             'relatedProperty' => $relatedProperty,
        //         ]);
        //     }
        // }
        // else
            
    }
}
