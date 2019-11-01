<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\MailRequest;
use App\Http\Requests\MailUpdateRequest;
use App\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    /*
    *Authorized the user with permission
    */
    function __construct(){
        $this->middleware('permission:config-list');
        $this->middleware('permission:config-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:config-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:config-delete', ['only' => ['destroy']]);

     }

     /**
      * Display a listing of the resource.
      * @param \Illuminate\Http\Request  $request
      * @return \Illuminate\View\View
      */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 5;

        if (!empty($keyword)) {
            $configurations = Configuration::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $configurations = Configuration::latest()->paginate($perPage);
        }

        return view('admin.configurations.index', compact('configurations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.configurations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(MailRequest $request)
    {


        $requestData = $request->all();
        
        Configuration::create($requestData);

        return redirect('admin/configurations')->with('success', 'configuration added!');
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Database\Eloquent\Model $configuration
     *
     * @return \Illuminate\View\View
     */
    public function show(configuration $configuration)
    {
        return view('admin.configurations.show', compact('configuration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Illuminate\Database\Eloquent\Model $configuration
     *
     * @return \Illuminate\View\View
     */
    public function edit(Configuration $configuration)
    {
        // $configuration = configuration::findOrFail($id);

        return view('admin.configurations.edit', compact('configuration'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @param \Illuminate\Database\Eloquent\Model $configuration
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(MailUpdateRequest $request, Configuration $configuration)
    {

        $requestData = $request->all();
        $configuration->update($requestData);

        return redirect('admin/configurations')->with('success', 'configuration updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model $configuration
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Configuration $configuration)
    {
        $configuration->delete();
        return redirect('admin/configurations')->with('success', 'configuration deleted!');

    }
}
