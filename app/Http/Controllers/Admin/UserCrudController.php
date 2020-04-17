<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\User');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/user');
        $this->crud->setEntityNameStrings('user', 'users');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        //$this->crud->setFromDb();
        $this->crud->addColumn(['name' => 'name' , 'type' => 'text' , 'label' => 'Name']);
        $this->crud->addColumn(['name' => 'email' , 'type' => 'email' , 'label' => 'E-mail']);
        $this->crud->addColumn([
            // 1-n relationship
            'label' => "Roles", // Table column heading
            'type' => "select",
            'name' => 'role_id', // the column that contains the ID of that connected entity;
            'entity' => 'roles', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\Role", // foreign key model
         ]);
         
    }


    protected function setupCreateOperation()
    {
        $this->crud->setValidation(UserRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->addField(['name' => 'name' , 'type' => 'text' , 'label' => 'Name']);
        $this->crud->addField(['name' => 'email' , 'type' => 'email' , 'label' => 'E-mail']);
        $this->crud->addField(['name' => 'password' , 'type' => 'password' , 'label' => 'Password']);
        
        //'password' => Hash::make($data['password']),
        $this->crud->addField([       // SelectMultiple = n-n relationship (with pivot table)
            'label' => "Roles",
            'type' => 'select_multiple',
            'name' => 'roles', // the method that defines the relationship in your Model
            'entity' => 'roles', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Role", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
        
           // optional
           'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);


        
    }

    protected function setupUpdateOperation()
    {
        $this->crud->setValidation(UserRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->addField(['name' => 'name' , 'type' => 'text' , 'label' => 'Name']);
        $this->crud->addField(['name' => 'email' , 'type' => 'email' , 'label' => 'E-mail']);
        $this->crud->addField([       // SelectMultiple = n-n relationship (with pivot table)
            'label' => "Roles",
            'type' => 'select_multiple',
            'name' => 'roles', // the method that defines the relationship in your Model
            'entity' => 'roles', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Role", // foreign key model
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
        
           // optional
           'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);
    }
}
