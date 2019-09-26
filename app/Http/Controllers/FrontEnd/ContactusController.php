<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Requests\ContactusRequest;
use App\Http\Controllers\Controller;
use App\Contactus;
use App\Configuration;
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
    public function store(ContactusRequest $request)
    {

        $input = $request->all();
        $contact = Contactus::create($input);
        $mail = Configuration::find(1);
        Mail::to($mail->value)->send(new NotificationToAdmin($contact));
         return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contactus $contactus)
    {
      // $contact = Contactus::findOrFail($id);

      return view('admin.contactus.show',compact('contactus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contactus $contactus)
    {
      // $contact = Contactus::findOrFail($id);
       return view('admin.contactus.edit',compact('contactus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactusRequest $request, Contactus $contactus)
    {

         $input = $request->all();
         // $message = Contactus::find($id);
           $contactus->update($input);
           $message = $contactus;

         $mail = Configuration::find(1);
         Mail::to($message->email)->send(new Notebyadmin($message));
         return redirect('admin/contactus')->with('success', 'Note Addred by admin!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contactus $contactus)
    {
         $contactus->delete();
        return redirect('admin/contactus')->with('success', 'Message deleted!');

    }
}
