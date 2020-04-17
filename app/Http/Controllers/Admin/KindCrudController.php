<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\KindRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class KindCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class KindCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Kind');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/kind');
        $this->crud->setEntityNameStrings('kind', 'kinds');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();
        $this->crud->addcolumn(['name' => 'name' , 'label' => 'Name' , 'type' => 'text']);
        $this->crud->addcolumn(['name' => 'number_of_kinds', 'type' => 'number' , 'label' => 'Properties number' ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(KindRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        //$this->crud->setFromDb();
        $this->crud->addField(['name' => 'name', 'type' => 'text', 'label' => 'Name']);
        $this->crud->addField([
            'label' => "Profile Image",
            'name' => "image",
            'type' => 'image',
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

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        $this->crud->addcolumn(['name' => 'name' , 'label' => 'Name' , 'type' => 'text']);
        $this->crud->addcolumn(['name' => 'number_of_kinds' , 'label' => 'Properties number' , 'type' => 'number']);
        $this->crud->addColumn([
            'name' => 'image', // The db column name
            'label' => "image", // Table column heading
            'type' => 'image',
             'prefix' => '/storage/',
             // image from a different disk (like s3 bucket)
             // 'disk' => 'local', 
             // optional width/height if 25px is not ok with you
              'height' => '30px',
              'width' => '30px',
         ]);
    }
}
