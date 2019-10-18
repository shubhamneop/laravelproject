<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmailtemplateRequest;
use App\EmailTemplate;
use Illuminate\Http\Request;

class EmailTemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $emailtemplates = EmailTemplate::where('name', 'LIKE', "%$keyword%")
                ->orWhere('subject', 'LIKE', "%$keyword%")
                ->orWhere('message', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $emailtemplates = EmailTemplate::latest()->paginate($perPage);
        }

        return view('admin.email-templates.index', compact('emailtemplates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.email-templates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(EmailtemplateRequest $request)
    {

        $requestData = $request->all();

        EmailTemplate::create($requestData);

        return redirect('admin/email-templates')->with('flash_message', 'EmailTemplate added!');
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
        $emailtemplate = EmailTemplate::findOrFail($id);

        return view('admin.email-templates.show', compact('emailtemplate'));
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
        $emailtemplate = EmailTemplate::findOrFail($id);

        return view('admin.email-templates.edit', compact('emailtemplate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(EmailtemplateRequest $request, $id)
    {
      
        $requestData = $request->all();

        $emailtemplate = EmailTemplate::findOrFail($id);
        $emailtemplate->update($requestData);

        return redirect('admin/email-templates')->with('flash_message', 'EmailTemplate updated!');
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
        EmailTemplate::destroy($id);

        return redirect('admin/email-templates')->with('flash_message', 'EmailTemplate deleted!');
    }
}
