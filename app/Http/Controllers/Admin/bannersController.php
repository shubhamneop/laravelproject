<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\banner;
use Illuminate\Http\Request;

class bannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    function __construct(){
        $this->middleware('permission:banner-list');
        $this->middleware('permission:banner-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:banner-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:banner-delete', ['only' => ['destroy']]);

     }

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $banners = banner::where('name', 'LIKE', "%$keyword%")
                ->orWhere('bannername', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $banners = banner::latest()->paginate($perPage);
        }

        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
       $this->validate($request,[
           'name'=>'required',
           'bannername'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
       ]);

        $requestData = $request->all();
        if ($request->hasFile('bannername')) {
            $requestData['bannername'] = $request->file('bannername')
                ->store('banner', 'public');
        }
        banner::create($requestData);

        return redirect('admin/banners')->with('success', 'banner added!');
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
        $banner = banner::findOrFail($id);

        return view('admin.banners.show', compact('banner'));
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
        $banner = banner::findOrFail($id);

        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required',
            'bannername'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


        $requestData = $request->all();
        if ($request->hasFile('bannername')) {
            $requestData['bannername'] = $request->file('bannername')
                ->store('banner', 'public');
        }
        $banner = banner::findOrFail($id);
        $banner->update($requestData);

        return redirect('admin/banners')->with('success', 'banner updated!');
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
        banner::destroy($id);

        return redirect('admin/banners')->with('success', 'banner deleted!');
    }
}
