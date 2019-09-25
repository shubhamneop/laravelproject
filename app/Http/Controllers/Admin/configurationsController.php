<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\MailRequest;
use App\Http\Requests\MailUpdateRequest;
use App\configuration;
use Illuminate\Http\Request;

class configurationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    function __construct(){
        $this->middleware('permission:config-list');
        $this->middleware('permission:config-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:config-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:config-delete', ['only' => ['destroy']]);

     }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 5;

        if (!empty($keyword)) {
            $configurations = configuration::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $configurations = configuration::latest()->paginate($perPage);
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

        configuration::create($requestData);

        return redirect('admin/configurations')->with('success', 'configuration added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $configuration = configuration::findOrFail($id);

        return view('admin.configurations.show', compact('configuration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $configuration = configuration::findOrFail($id);

        return view('admin.configurations.edit', compact('configuration'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(MailUpdateRequest $request, $id)
    {

        $requestData = $request->all();

        $configuration = configuration::findOrFail($id);
        $configuration->update($requestData);

        return redirect('admin/configurations')->with('success', 'configuration updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        configuration::destroy($id);
        return redirect('admin/configurations')->with('success', 'configuration deleted!');
        //return redirect('admin/configurations')->with('flash_message', 'configuration deleted!');
    }
}
