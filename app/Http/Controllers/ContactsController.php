<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$user = Auth::user();
        return view('contact.index', compact('user'));
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
    public function store(Request $request){
			$this->validate($request, [
				'name' => ['required', 'string', 'max:24'],
				'lastname' => ['required', 'string', 'max:24'],
				'email' => ['required', 'string', 'email', 'max:255'],
				'object' => ['required', 'string', 'max:500'],
				'description' => ['required']
			]);

			$messagebody  = 'MIME-Version: 1.0' . "\r\n";
			$messagebody .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			$messagebody .= 'De: ' . htmlentities($request->name) . "\r\n";
			$objet = 'Message depuis le site Lan Creator';

			$mail_cleaning = array("content-type","bcc:","to:","cc:","href");
			$msg = str_replace($mail_cleaning,"",htmlentities($request->description));


			$messagebody .= '<h1>'.$objet.'</h1>
			<p><strong>' . htmlentities($request->lastname) .' '. htmlentities($request->name) .'</strong> a écrit :</p>
			<p><strong>Message : </strong>' . $msg . '</p>';

			$sender = $request->email;
			$object = $request->object;

			Mail::send([], [], function ($message) use ($sender, $object, $messagebody) {
			  $message->to('lancreator.noreply@gmail.com')
					->from($sender)
					->subject($object)
					->setBody($messagebody,'text/html');
			});

			return response()->json([
				'success'=>'Your mail has been saved successfully.'
			]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
