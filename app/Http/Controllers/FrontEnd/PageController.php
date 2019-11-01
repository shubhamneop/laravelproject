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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\view\view
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



    /**
     * Display the specified resource.
     *
     * @param Illuminate\Database\Eloquent\Model $page
     * @return \Illuminate\Http\Response
     * @return \Illuminate\View\view
     */
     public function show(Page $page)
     {

        return view('admin.pages.show',compact('page'));
     }

     /**
      * Display the specified resource.
      *
      * @param string $slug
      * @return \Illuminate\Http\Response
      * @return \Illuminate\View\view
      */
    public function showpage($slug)
    {

       $pages = Page::slug($slug)->statusActive()->get();
       if(count($pages)<=0){
         return view('Frontend.404');
       }else {

         foreach ($pages as $page) {
            $status= $page->status;
         }
         if($status==0){
          return view('Frontend.404');
         }else{
          return view('pages',compact('pages'));
         }
       } 

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Illuminate\Database\Eloquent\Model $page
     * @return \Illuminate\Http\Response
     * @return |Illuminate\View\View
     */
    public function edit(Page $page)
    {

      return view('admin.pages.edit',compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Illuminate\Database\Eloquent\Model $page
     * @return \Illuminate\Http\Response
     */
    public function update(PageUpdateRequest $request, Page $page)
    {
      $input = $request->all();
      $input['status'] = $request->input('status');

       $page->update($input);
       return redirect('admin/pages')->with('success','Content updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Illuminate\Database\Eloquent\Model $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
      $page->delete();
        return redirect('admin/pages')->with('success','Page deleted successfully');
    }
}
