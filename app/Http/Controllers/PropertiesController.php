<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Storage;
use App\Property;
use Auth;
use App\Detail;
use App\City;

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
        $filenameWithExt = $request->file('photo')->getClientOriginalName();

        // Get Just the Filename
        $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);

        // GEt Extension
        $extension = $request->file('photo')->getClientOriginalExtension();

        // Create New FileName
        $filenameToSave = $filenameWithExt.'_'.time().'.'.$extension;
        
        $path = "public/photos/".$request->input('property_id') ;

        $request->file('photo')->storeAs($path , $filenameToSave);

        $property = new Property;
        $property->user_id = Auth::user()->id;
        $property->square = $request->input('square');
        $property->bathroom = $request->input('bathroom');
        $property->bedroom = $request->input('bedroom');
        $property->garage = $request->input('garage');
        $property->old = $request->input('old');
        $property->description = $request->input('description');
        $property->address = $request->input('address');
        $property->price = $request->input('price');
        $property->rent_sale = $request->input('rent_sale');
        $property->photo = $filenameToSave;
        $property->city_id =$request->input('city_id');
        $property->kind_id =$request->input('kind_id');
        $property->save();

        $property->details()->attach(request('details'));
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
        $filenameToSave = NULL;
        if($request->has('photo')){

            Storage::delete('public/photos/' . $property->photo);
            $filenameWithExt = $request->file('photo')->getClientOriginalName();

            // Get Just the Filename
            $filename = pathinfo($filenameWithExt , PATHINFO_FILENAME);

            // GEt Extension
            $extension = $request->file('photo')->getClientOriginalExtension();
            
            // Create New FileName
            $filenameToSave = $filenameWithExt.'_'.time().'.'.$extension;
            
            $path = "public/photos/".$request->input('property_id') ;

            $request->file('photo')->storeAs($path , $filenameToSave);
        }

        $property->user_id = Auth::user()->id;
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
        if($filenameToSave)
            $property->photo = $filenameToSave;
        $property->description = $request->input('description');
        $property->save();
        $property->details()->sync(request('details'));
        return redirect('/' . Auth::user()->email);
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
        Storage::delete('public/photos/' . $property->photo);
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
            'photo' => 'image|dimensions:max_width=350,max_height=350|max:1999',
        ]);
    }
    
}
