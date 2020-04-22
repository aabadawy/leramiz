<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PropertyRequest;
use Request;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\City;
use App\Models\Kind;
use App\Models\Property;

/**
 * Class PropertyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PropertyCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation; 
    // use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation

    public function setup()
    {
        $this->crud->setModel('App\Models\Property');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/property');
        $this->crud->setEntityNameStrings('property', 'properties');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();
        $this->crud->addcolumn(['name' => 'user.name' , 'type' => 'text', 'label' => 'Owner']);
        $this->crud->addcolumn(['name' => 'square' , 'type' => 'number', 'label' => 'Square']);
        $this->crud->addcolumn(['name' => 'address' , 'type' => 'text', 'label' => 'Address']);
        $this->crud->addcolumn(['name' => 'city.name' , 'type' => 'text', 'label' => 'City']);
        $this->crud->addcolumn(['name' => 'kind.name' , 'type' => 'text', 'label' => 'Kind']);
        $this->crud->addcolumn(['name' => 'price' , 'type' => 'number', 'label' => 'Price']);
        $this->crud->addcolumn(['name' => 'rent_sale' , 'type' => 'text', 'label' => 'Rent Or Sale']);
    }
    public function update()
    {
        // Geting The Id Of the Property before changing any thing
        $id = $this->crud->getCurrentEntryId();
        $prop = Property::find($id);
        $old_city_id = $prop->city_id;
        $old_kind_id =$prop->kind_id ;

        // Update The Property
        $response = $this->traitUpdate();
        //After Update Property , going to Change The Number Of Properties in City Model
        // But Before It We Checking if This City_id is The same of old city_id before editing that
        if($this->crud->getEntry($id)->city_id != $old_city_id)
        {
            $old_city = City::find($prop->city_id);
            $old_city->number_of_properties -- ;
            $old_city->save();
        }
        if($this->crud->getEntry($id)->kind_id != $old_kind_id)
        {
            $old_kind = Kind::find($prop->kind_id);
            $old_kind->number_of_properties -- ;
            $old_kind->save();
        }
        return $response ;
    }


    protected function setupCreateOperation()
    {
        
        $this->crud->setValidation(PropertyRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();

        $this->crud->addField(['name' => 'user_id' ,
         'type' => 'select',
          'entity' => 'user' , 
          'attribute' => 'name', 
          'label' => 'Owner' ,
          'model' => "App\Models\User",
          'options'   => (function ($query) {
            return $query->orderBy('name', 'ASC')->get();
        }), 

          ]);
        $this->crud->addField(['name' => 'square' , 'type' => 'number', 'label' => 'Square']);
        $this->crud->addField(['name' => 'bedroom' , 'type' => 'number', 'label' => 'Bedrooms']);
        $this->crud->addField(['name' => 'bathroom' , 'type' => 'number', 'label' => 'Bathrooms']);
        $this->crud->addField(['name' => 'garage' , 'type' => 'number', 'label' => 'Garage']);
        $this->crud->addField(['name' => 'old' , 'type' => 'number', 'label' => 'Old']);
        $this->crud->addField(['name' => 'address' , 'type' => 'text', 'label' => 'Address' ]);
        $this->crud->addField(['label' => "City",
        'type' => 'select2',
        'name' => 'city_id', // the db column for the foreign key
        'entity' => 'city', // the method that defines the relationship in your Model
        'attribute' => 'name', // foreign key attribute that is shown to user
     
        // optional
        'model' => "App\Models\City",
        'options'   => (function ($query) {
             return $query->orderBy('name', 'ASC')->get();
         }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);


        $this->crud->addField(['label' => "Kind",
        'type' => 'select2',
        'name' => 'kind_id', // the db column for the foreign key
        'entity' => 'kind', // the method that defines the relationship in your Model
        'attribute' => 'name', // foreign key attribute that is shown to user
     
        // optional
        'model' => "App\Models\kind",
        'options'   => (function ($query) {
             return $query->orderBy('name', 'ASC')->get();
         }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);

        
        $this->crud->addField([       // SelectMultiple = n-n relationship (with pivot table)
            'label' => "Details",
            'type' => 'select2_multiple',
            'name' => 'details', // the method that defines the relationship in your Model
            'entity' => 'details', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Detail", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
        
           // optional
           'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);

        $this->crud->addField(['name' => 'price' , 'type' => 'number', 'label' => 'Price']);
        $this->crud->addField(['name' => 'rent_sale',
        'label' => "Rent or Sale",
        'type' => 'select2_from_array',
        'options' => ['rent' => 'Rent', 'sale' => 'Sale'],
        'allows_null' => false,
        'default' => 'sale',
        ]);
        $this->crud->addField([
            'label' => 'image',
            'name' => 'image',
            'type' => 'image',
            'allows_null' => false,
            'upload' => true,
            'crop' => true, // set to true to allow cropping, false to disable
            //'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
            // 'disk' => 's3_bucket', // in case you need to show images from a different disk
            'prefix' => '/storage/', // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
        ]);
        
    }

    protected function setupUpdateOperation()
    {
        
        
        $this->setupCreateOperation();
        
        
    }

    protected  function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);
        
        $this->crud->addcolumn(['name' => 'user.name' , 'type' => 'text', 'label' => 'Owner']);
        $this->crud->addcolumn(['name' => 'square' , 'type' => 'number', 'label' => 'Square']);
        $this->crud->addcolumn(['name' => 'bedroom' , 'type' => 'number', 'label' => 'Bedrooms']);
        $this->crud->addcolumn(['name' => 'bathroom' , 'type' => 'number', 'label' => 'Bathrooms']);
        $this->crud->addcolumn(['name' => 'garage' , 'type' => 'number', 'label' => 'Garage']);
        $this->crud->addcolumn(['name' => 'old' , 'type' => 'number', 'label' => 'Old']);
        $this->crud->addcolumn(['name' => 'address' , 'type' => 'text', 'label' => 'Address' ]);
        $this->crud->addcolumn(['name' => 'city.name' , 'type' => 'text', 'label' => 'City']);
        $this->crud->addcolumn(['name' => 'kind.name' , 'type' => 'text', 'label' => 'Kind']);
        $this->crud->addcolumn(['name' => 'price' , 'type' => 'double', 'label' => 'Price']);
        $this->crud->addcolumn([
            // n-n relationship (with pivot table)
            'label' => "Details", // Table column heading
            'type' => "select_multiple",
            'name' => 'details', // the method that defines the relationship in your Model
            'entity' => 'details', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\Models\Detail", // foreign key model
         ]);
        $this->crud->addcolumn(['name' => 'rent_sale' , 'type' => 'text', 'label' => 'Rent Or Sale']);
        $this->crud->addColumn([
            'name' => 'image', // The db column name
            'label' => "image", // Table column heading
            'type' => 'image',
             'prefix' => '/storage/',
             // image from a different disk (like s3 bucket)
             //'disk' => 'local', 
             // optional width/height if 25px is not ok with you
              'height' => '30px',
              'width' => '30px',
         ]);
    }
}
