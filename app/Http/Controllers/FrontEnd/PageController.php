<?php

namespace App\Http\Controllers\Admin;
namespace App\Http\Controllers\FrontEnd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Page;
class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $keyword = $request->get('search');
   $perPage = 5;

   if (!empty($keyword)) {
      $pages = Page::where('name', 'LIKE', "%$keyword%")
              ->orwhere('title', 'LIKE', "%$keyword%")
           ->latest()->paginate($perPage);

        } else {

          $pages  = Page::orderBy('id')->paginate(5);

       }
        return view('admin.pages.index',compact('pages'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request,[
          'name'=>'required',
          'title'=>'required|unique:pages,title',
          'slug'=>'required',
       ]);
       $input =$request->all();

       Page::create($input);
       return redirect('admin/pages')->with('success','Page created successfully');
    }


    public function getRouteKeyName()
    {
     return 'slug';
     }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
     {
        $page = Page::find($id);
        return view('admin.pages.show',compact('page'));
     }

    public function showpage($slug)
    {
       $pages = Page::where('slug',$slug)->get();

      return view('pages',compact('pages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $page = Page::find($id);
      return view('admin.pages.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Page::find($id)->delete();
        return redirect('admin/pages')->with('success','Page deleted successfully');
    }
}
