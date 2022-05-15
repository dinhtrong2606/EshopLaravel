<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    public function index(){
        $contacts = Contact::orderBy('contact_id', 'DESC')
            ->get();

        return view('admin.contact.index')->with(compact('contacts'));
    }

    public function delete($contact_id){
        Contact::find($contact_id)->delete();
        return Redirect()->back()->with('status', 'Bạn đã xóa contact thành công!');
    }
}
