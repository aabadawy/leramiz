<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\contactOwner;
use App\Mail\contactMe;
use Auth;
class ContactController extends Controller
{
    public function sendMail()
    {
        if(!Auth::guest())
        {
            request()->validate([
                'toemail' => 'required|email',
                'content' => 'required',
                'propid' => 'required'
                ]);
        
        
            Mail::to(request('email'))
                ->send(new contactOwner(Auth::user()->email, Auth::user()->name , request('content') , request('propid')));
        }
        else
        {
            request()->validate([
                'email' => 'required|email',
                'name' => 'required',
                'toemail' => 'required|email',
                'content' => 'required',
                'propid' => 'required'
                ]);
            Mail::to(request('toemail'))
                ->send(new contactOwner(request('email') , request('name') , request('content') ,request('propid')));
        }
        return back()->with('message' , 'your Email sent successfully!');
    }
    public function contactme()
    {
        if(!Auth::guest())
        {
            request()->validate([
                'toemail' => 'required|email',
                'content' => 'required',
                ]);
        
        
            Mail::to(request('toemail'))
                ->send(new contactMe(Auth::user()->email, Auth::user()->name , request('content') ));
        }
        else
        {
            request()->validate([
                'email' => 'required|email',
                'name' => 'required',
                'toemail' => 'required|email',
                'content' => 'required',
                ]);
            Mail::to(request('toemail'))
                ->send(new contactMe(request('email') , request('name') , request('content')));
        }
        return back()->with('message' , 'your Email sent successfully!');
    }
}
