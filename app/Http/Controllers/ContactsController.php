<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactsController extends Controller
{
	/**
	* Show the contact form
	*
	* @return \Illuminate\Http\Response
	*/
	public function index(){
		if(Auth::check()){
			$user = Auth::user();
			return view('contact.index', compact('user'));
		}else{
			return view('contact.index');
		}
	}

	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request){
		if($this->validate($request, [
			'name' => ['required', 'string', 'max:24'],
			'lastname' => ['required', 'string', 'max:24'],
			'email' => ['required', 'string', 'email', 'max:255'],
			'object' => ['required', 'string', 'max:500'],
			'description' => ['required']
		])){


			$mail_cleaning = array("content-type","bcc:","to:","cc:","href");

			$sender = htmlentities($request->email);

			$object = htmlentities($request->object);
			$name = htmlentities($request->name);
			$lastname = htmlentities($request->lastname);
			$email = htmlentities($request->email);
			$content = str_replace($mail_cleaning,"",htmlentities($request->description));

			if($request->file('file')){
				$file=$request->file('file');
				Mail::send('contact.mail', ['name' => $name, 'lastname' => $lastname, 'email' => $email, 'content' => $content], function ($message) use ($sender, $object,$file) {
					$message->to('lancreator.noreply@gmail.com')
					->from($sender, 'Lan Creator')
					->cc($sender)
					->subject($object)
					->attach($file->getRealPath(),[
						'as'=>$file->getClientOriginalName(),
						'mime'=>$file->getMimeType()
					]);
				});
			}else{
				Mail::send('contact.mail', ['name' => $name, 'lastname' => $lastname, 'email' => $email, 'content' => $content], function ($message) use ($sender, $object) {
					$message->to('lancreator.noreply@gmail.com')
					->from($sender, 'Lan Creator')
					->cc($sender)
					->subject($object);
				});
			}

			return response()->json([
				'success'=>'Your mail has been sent successfully.'
			]);
		}else{
			return $this->validator($request);
		}
	}

	/**
	* Validates the contact form's data
	*
	* @param array $data form's data
	* @return boolean true if data is valid, false otherwise
	*/
	protected function validator(array $data){
		return Validator::make($data, [
			'name' => ['required', 'string', 'max:24'],
			'lastname' => ['required', 'string', 'max:24'],
			'email' => ['required', 'string', 'email', 'max:255'],
			'object' => ['required', 'string', 'max:500'],
			'description' => ['required']
		]);
	}
}
