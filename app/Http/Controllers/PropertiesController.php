<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;
use App\Property;
use Auth;
use App\Models\Detail;
use App\Models\City;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::orderBy('created_at','desc')->paginate(12);
        
        $city_id = null;
        if(request('city')){
            foreach (City::all() as $city) {
                if($city->name == request('city')){
                    $city_id = $city->id ;
                }
            }
            $properties = Property::where('city_id' , $city_id)->paginate(12);
        }
        
        return view('property.index' ,[
            'properties' => $properties,
        ]);
        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateProperty($request);
        
        $property = new Property;

        $this->changingNumberOfProperties($property , $request , 0) ;

        $this->save($property , $request);

        return redirect('/' . Auth::user()->email);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $property = Property::findOrFail($id);
        $relatedProperty = property::all()->where('kind' , $property->kind);
        $cities = City::all();
        return view('property.show',[
            'property' => $property,
            'relatedProperty' => $relatedProperty,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $property = Property::findOrFail($id);
        if(!$property->isOwner())
        {
            return abort(404);
        }
        $details = Detail::all()->pluck('name' , 'id');
        return view('property.edit',[
            'property' => $property,
            'details' => $details,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validateProperty($request);

        $property = Property::findOrFail($id);
        if(!$property->isOwner())
        {
            return abort(404);
        }
        $this->changingNumberOfProperties($property , $request , $property->city_id);

        $this->save($property , $request);


        return redirect('/property/' . $property->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        if(!$property->isOwner())
        {
            return abort(404);
        }
        Storage::delete('public/' . $property->image);
        $city = City::findOrFail($property->city_id);
        $city->number_of_properties -- ;
        $city->save();
        $property->delete();
            return redirect('/');
    }

    public function validateProperty(Request $request){
        $this->validate($request, [
            'square' => 'required|integer|min:30',
            'bathroom' => 'required|integer|min:1',
            'bedroom' => 'required|integer|min:1',
            'garage' => 'required|integer|min:0',
            'old' => 'required|integer|min:0',
            'city_id' => 'required',
            'address' => 'required|string|min:10',
            'price' => 'required|integer',
            'kind_id' => 'required',
            'image' => 'max:1999'
        ]);
    }

    // Save The data to DB 
    public function save(Property $property , Request $request)
    {
        
        $property->user_id = Auth::user()->id ;
        $property->square = $request->input('square');
        $property->bathroom = $request->input('bathroom');
        $property->bedroom = $request->input('bedroom');
        $property->garage = $request->input('garage');
        $property->kind_id = $request->input('kind_id');
        $property->old = $request->input('old');
        $property->city_id = $request->input('city_id');
        $property->address = $request->input('address');
        $property->price = $request->input('price');
        $property->rent_sale = $request->input('rent_sale');
        $property->image = $this->savingImage($request , $property);
        $property->description = $request->input('description');
        $property->save();
        
        
        $property->details()->sync(request('details'));
    }

    //Checking is there image added , and return the name of the file to be saved
    public function savingImage(Request $request , Property $property)
    {
        $filenameToSave = 'final.jpg';
        if($request->has('image')){

            Storage::delete('public/' . $property->image);
            $filenameWithExt = $request->file('image')->getClientOriginalName();

            // Get Just the Filename
            $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);

            // GEt Extension
            $extension = $request->file('image')->getClientOriginalExtension();
            
            // Create New FileName
            $filenameToSave ='photos/'. $filenameWithExt.'_'.time().'.'.$extension;
            
            $path = "public/";

            $request->file('image')->storeAs($path , $filenameToSave);
        }
        return $filenameToSave;
    }

    public function changingNumberOfProperties(Property $property, Request $request , $old_id)
    {

        $old_city_id = $old_id;
        
        
        $city = City::find($request->input('city_id'));

        if($city->id != $old_city_id && !$request->is('property')){
            $old_city = City::findOrFail($old_city_id);
            $old_city->number_of_properties -- ;
            $old_city->save();
            $city->number_of_properties ++ ;
            $city->save();
        }
        else
        {
            if($request->is('property'))
            {
                $city->number_of_properties ++ ;
                $city->save();
            }
        }
    }
    
}
