<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule ;


class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware(('can:isAdmin')) ;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::query();

        if($keyword = request('search')){
            $roles->where('name' , 'LIKE' ,  "%$keyword%")->orWhere('label' , 'LIKE', "%$keyword%");
        }

        $roles = $roles->paginate(10);
        return view('admin.roles.all' , compact('roles') );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create') ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255' , 'unique:roles'],
            'label' => ['required', 'string', 'max:255' ],
            'permissions' => ['required' , 'array']
        ]);


        $role = Role::create($data);
        $role->permissions()->sync($data['permissions']);


        alert()->success('Role Created SUCCESSFULLY' , 'Creation Complete');
        return redirect(route('admin.roles.index')) ;
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return  view('admin.roles.edit' , compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $data= $request->validate([
            'name' => ['required', 'string', 'max:255' , Rule::unique('roles')->ignore($role->id)],
            'label' => ['required', 'string', 'max:255'],
            'permissions' => ['required' , 'array']
        ]);

        $role->update($data) ;
        $role->permissions()->sync($data['permissions']) ;
        
        alert()->success('Your User Edited Successfully' , 'Edition Complete');
        return redirect(route('admin.roles.index')) ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        alert()->success('Role Deleted Successfully' , 'Delete Complete');
        return redirect(route('admin.roles.index')) ;
    }
}
