<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_role()
    {
       return Role::all();
    }

    public function index_permissions()
    {
       return Permission::all();
    }

    public function assign_permission_to_role() {}


    public function remove_permission_to_role() {}
}
