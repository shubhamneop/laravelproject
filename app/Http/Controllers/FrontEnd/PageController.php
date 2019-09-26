<?php

namespace App\Http\Controllers\Admin;
namespace App\Http\Controllers\FrontEnd;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequest;
use App\Http\Requests\PageUpdateRequest;
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
              ->orwhere('slug', 'LIKE', "%$keyword%")
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
    public function store(PageRequest $request)
    {

          $page = new Page;
          $page->name=$request->input('name');
          $page->title=$request->input('title');
          $page->slug=$request->input('slug');
          $page->content=$request->input('content');
          $page->status=$request->input('status');
          $page->save();





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
     public function show(Page $page)
     {

        return view('admin.pages.show',compact('page'));
     }

    public function showpage($slug)
    {
       $pages = Page::where('slug',$slug)->get();
         foreach ($pages as $page) {
            $status= $page->status;
         }
         if($status=='inactive'){
          return view('Frontend.404');
         }else{
          return view('pages',compact('pages'));
         }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {

      return view('admin.pages.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PageUpdateRequest $request, $id)
    {
      $input = $request->all();
      $input['status'] = $request->input('status');
       $page = Page::find($id);
       $page->update($input);
       return redirect('admin/pages')->with('success','Content updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
      $page->delete();
        return redirect('admin/pages')->with('success','Page deleted successfully');
    }
}
