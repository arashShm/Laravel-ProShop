<?php

namespace Modules\Main\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Nwidart\Modules\Facades\Module;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $modules = Module::aLL();
        return view('main::admin.all', compact('modules'));
    }


    public function disable($module)
    {
        $module = Module::find($module);
        if (Module::canDisable($module->getName()))
            $module->disable();

        alert()->success('Module Disabled');
        return back();
    }


    public function enable($module)
    {
        $module = Module::find($module);
        if (Module::canDisable($module->getName()))
            $module->enable();

        alert()->success('Module Enabled');
        return back();
    }
}
