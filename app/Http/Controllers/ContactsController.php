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
    public function store(Request $request)
    {
			$this->validate($request, [
				'name' => ['required', 'string', 'max:24'],
				'lastname' => ['required', 'string', 'max:24'],
				'email' => ['required', 'string', 'email', 'max:255'],
				'object' => ['required', 'string', 'max:500'],
				'description' => ['required']
			]);

			$mail_cleaning = array("content-type","bcc:","to:","cc:","href");

			$sender = htmlentities($request->email);

			$object = htmlentities($request->object);
			$name = htmlentities($request->name);
			$lastname = htmlentities($request->lastname);
			$email = htmlentities($request->email);
			$title = 'Message depuis le site Lan Creator';
			$content = str_replace($mail_cleaning,"",htmlentities($request->description));

			Mail::send('contact.mail', ['name' => $name, 'lastname' => $lastname, 'email' => $email, 'title' => $title, 'content' => $content], function ($message) use ($sender, $object) {
			  $message->to('lancreator.noreply@gmail.com')
					->from($sender, 'Lan Creator')
					->cc($sender)
					->subject($object);
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
