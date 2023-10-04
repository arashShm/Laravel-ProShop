<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule ;


class PermissionController extends Controller
{


    public function __construct()
    {
        $this->middleware('can:staff-user-permissions')->only(['setPermissionCreate' , 'setPermissionStore']) ;
        $this->middleware(('can:isAdmin')) ;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::query();

        if($keyword = request('search')){
            $permissions->where('name' , 'LIKE' ,  "%$keyword%")->orWhere('label' , 'LIKE', "%$keyword%");
        }

        $permissions = $permissions->paginate(10);
        return view('admin.permissions.all' , compact('permissions') );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.permissions.create') ;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255' , 'unique:permissions'],
            'label' => ['required', 'string', 'max:255' ],
        ]);

        $permission = Permission::create($data);

        alert()->success('Permission Created SUCCESSFULLY' , 'Creation Complete');
        return redirect(route('admin.permissions.index')) ;
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        return  view('admin.permissions.edit' , compact('permission'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $data= $request->validate([
            'name' => ['required', 'string', 'max:255' , Rule::unique('permissions')->ignore($permission->id)],
            'label' => ['required', 'string', 'max:255'],
        ]);

        $permission->update($data) ;

        alert()->success('Your User Edited Successfully' , 'Edition Complete');
        return redirect(route('admin.permissions.index')) ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        alert()->success('Permission Deleted Successfully' , 'Delete Complete');
        return redirect(route('admin.permissions.index')) ;
    }




    public function setPermissionCreate(User $user)
    {
        return view('admin.users.permissions' , compact('user')) ;
    }



    public function setPermissionStore(Request $request , User $user)
    {

        $user->permissions()->sync($request->permissions) ;
        $user->roles()->sync($request->roles) ;


        alert()->success('Access Changed Successfully' , 'Access Change Complete');
        return redirect(route('admin.users.index')) ;
    }



}
