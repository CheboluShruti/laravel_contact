<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Contact;

class ContactsController extends Controller
{
   public function index()
   {


   	$Recent_data = DB::table('contacts')->limit(10)->get();

   	$contact_data = DB::table('contacts')->latest()->get();
   	
   	return view ('contacts.index',compact('Recent_data','contact_data'));
   }

   public function edit_contact($contactID)
   {
   		$edit_data = DB::table('contacts')->find($contactID);
   		return view ('contacts.edit',compact('edit_data'));
   }

   public function update_contact(Request $request)
   {
   		
   		
   		$name = $request->input('name');
   		$email = $request->input('email');
   		$mobile = $request->input('mobile');
   		$contactID = $request->input('ContactID');
   		$added = date("Y-m-d H:i:s");
   		$updateArray = ['name'=>$name,'email'=>$email,'mobile'=>$mobile,'updated_at'=>$added];
   		DB::table('contacts')->where('id',$contactID)->update($updateArray);

   		return redirect('/');

   		//return $request->input('name');

   }


}
