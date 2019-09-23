<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contactus;
use App\configuration;
use App\Mail\NotificationToAdmin;
use App\Mail\Notebyadmin;
use Illuminate\Support\Facades\Mail;

class ContactusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $keyword = $request->get('search');
      $perPage = 4;

               if (!empty($keyword)) {
          $contacts = Contactus::where('name', 'LIKE', "%$keyword%")
              ->orWhere('email', 'LIKE', "%$keyword%")
              ->orWhere('subject','LIKE',"%$keyword%")
              ->latest()->paginate($perPage);
      } else {
          $contacts = Contactus::latest()->paginate($perPage);
      }


      return view('admin.contactus.index',compact('contacts'))->with('i', ($request->input('page', 1) - 1) * 4);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        'contactno'=>'required|numeric|min:10',
        'email'=>'required|email',
        'subject'=>'required',
        'message'=>'required',
      ]);
        $input = $request->all();
        $contact = Contactus::create($input);
        $mail = configuration::find(1);
        Mail::to($mail->value)->send(new NotificationToAdmin($contact));
         return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $contact = Contactus::findOrFail($id);

      return view('admin.contactus.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $contact = Contactus::findOrFail($id);
       return view('admin.contactus.edit',compact('contact'));
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
      $this->validate($request,[
        'name'=>'required',
        'contactno'=>'required|numeric|min:10',
        'email'=>'required|email',
        'subject'=>'required',
        'message'=>'required',
      ]);
         $input = $request->all();
         $message = Contactus::find($id);
         $message->update($input);
         $mail = configuration::find(1);
         Mail::to($message->email)->send(new Notebyadmin($message));
         return redirect('admin/contactus')->with('success', 'Note Addred by admin!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Contactus::destroy($id);
        return redirect('admin/contactus')->with('success', 'Message deleted!');

    }
}
