<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PropertyRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PropertyCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PropertyCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

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
          'model' => "App\User",
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
        'type' => 'select',
        'name' => 'city_id', // the db column for the foreign key
        'entity' => 'city', // the method that defines the relationship in your Model
        'attribute' => 'name', // foreign key attribute that is shown to user
     
        // optional
        'model' => "App\City",
        'options'   => (function ($query) {
             return $query->orderBy('name', 'ASC')->get();
         }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);


        $this->crud->addField(['label' => "Kind",
        'type' => 'select',
        'name' => 'kind_id', // the db column for the foreign key
        'entity' => 'kind', // the method that defines the relationship in your Model
        'attribute' => 'name', // foreign key attribute that is shown to user
     
        // optional
        'model' => "App\kind",
        'options'   => (function ($query) {
             return $query->orderBy('name', 'ASC')->get();
         }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);

        $this->crud->addField(['name' => 'price' , 'type' => 'number', 'label' => 'Price']);
        $this->crud->addField(['name' => 'rent_sale',
        'label' => "Rent or Sale",
        'type' => 'select_from_array',
        'options' => ['Rent' => 'rent', 'Sale' => 'sale'],
        'allows_null' => false,
        'default' => 'Sale',
        ]);
        $this->crud->addField([
            'label' => 'photo',
            'name' => 'photo',
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
        $this->crud->addcolumn(['name' => 'rent_sale' , 'type' => 'text', 'label' => 'Rent Or Sale']);
        $this->crud->addColumn([
            'name' => 'photo', // The db column name
            'label' => "image", // Table column heading
            'type' => 'image',
             'prefix' => '/storage/photos/',
             // image from a different disk (like s3 bucket)
             //'disk' => 'local', 
             // optional width/height if 25px is not ok with you
              'height' => '30px',
              'width' => '30px',
         ]);
    }
}
