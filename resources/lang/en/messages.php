<?php

return [

	/*
	|--------------------------------------------------------------------------
	| App Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines are used by the LAN app.
	| these language lines according to your application's requirements.
	|
	*/

	'chln' => ' Change Language',

	// Menu

	'find_lan' => 'Find a LAN',
	'contact' => 'Contact',
	'login' => 'Login',
	'register' => 'Register',
	'logout' => 'Logout',
	'remember_me' => 'Remember me',
	'forgot_password' => 'Forgot Your Password?',
	'reset_password' => 'Reset Password',
	'send_reset_link' => 'Send Password Reset Link',
	'confirm_password_before' => 'Please confirm your password before continuing.',
	
	'lan_creator' => 'LAN Creator',


	// Home
	'home' => 'Home',
	'hometitle' => 'Create your LAN now !',
	'home_p1t' => 'Select your Games',
	'home_p1' => 'Link your Games to your LAN, review the connexion ports and choose your must-haves with our "fav" system ! You might even find some new ones...',
	'home_p2t' => 'Host unique Activities ',
	'home_p2' => 'Create heavily-customised tournaments, define what your own LAN is and more ! With our room mapping application, you also can see how everyone can fit !',
	'home_p3t' => 'Organization is key ',
	'home_p3' => 'Don\'t do it alone ! Add helpers, news admins, deploy tasks, define a shopping list and a to-do list to avoid some last-minute expenses !',

	'homestats' => 'The latest LAN was created on :date with :reg registrants !',
	'homejoin' => 'Sign-in now to create your first LAN !',


	'name' => 'Name',
	'lname' => 'Last Name',
	'pseudo' => 'Pseudo',
	'email' => 'E-Mail Address',
	'tel' => 'Phone number ',
	'password' => 'Password',
	'confirmpassword' => 'Confirm Password',
	'streetnbr' => 'Street number',
	'streetname' => 'Street name',
	'city' => 'City',
	'zip' => 'Zip',
	'depname' => 'Department name',
	'country' => 'Country',
	'address' => 'Address',

	'want_contact' => 'If you want to contact this user, please use the "Contact" button and wait for his reply on your mailbox.',

	// Stats
	'statistics' => 'Statistics',
	'user_admin_lan' => '{0} This user isn\'t an admin on any LAN currently |{1} This user is currently administrating :count lan|[2,*] This user is currently administrating :count lans',


	//echo trans_choice('time.minutes_ago', 5, ['value' => 5]);


	// Dashboard
	'chtheme' => 'Change Theme',
	'settings' => 'Settings',
	'view' => 'View',
	'edit' => 'Edit',
	'delete' => 'Delete',
	'ban' => 'Ban',
	'restore' => 'Restore',
	'show_hide' => 'Show/hide',
	'all' => 'All',


	'add' => 'Add',
	'actions' => 'Actions',
	'nohelper' => 'No helpers to show',
	'helpers' => 'Helpers',
	'admins' => 'Admins',
	'nouser' => 'No users to show',
	'first' => 'First',
	'back' => 'Back',
	'next' => 'Next',
	'last' => 'Last',
	'search' => 'Search',
	'back_admin_dash' => 'Return to the admin Dashboard',


	'admin_lan' => 'All the admins for the LAN ',
	'add_new_admin' => 'Add a new Admin',
	'adding_admin_lan' => 'Adding admin to Lan :',
	'admin_name' => 'Admin\'s name :',

	'helper_lan' => 'All the helpers for the LAN ',
	'add_new_helper' => 'Add a new Helper',
	'adding_helper_lan' => 'Adding helper to LAN :',
	'helper_name' => 'Helper\'s name :',

	'back_home' => ' Go back to the home page',
	'back_lan' => ' Go back to the LAN',
	'back_dashboard' => ' Go back to the dashboard',

	'participants' => 'Participants',
	'state' => 'State',
	'quit' => 'Quit',

	'navigation' =>'Navigation',
	'dashboard' =>'Dashboard',
	'lan' =>'LAN',
	'all_lans' =>'All LANs',
	'my_tasks' =>'My Tasks',

	'games' =>'GAMES',
	'all_games' =>'All games',
	'my_games' =>'My games',
	
	'admin' => 'ADM',
	'admin_dashboard' => 'Admin dashboard',
	'all_users' => 'All Users',
	'all_tournaments' => 'All Tournaments',

	'no_lans' =>'No LANs to show',

	'my_lans' =>'My LANs',
	'my_lans_helper' =>'LANs on which I am helper',
	'my_lans_player' =>'LANs on which I am player',

	'create_new_lan' =>'Create New LAN',
	
	// LAN

	'nb_max_registrants' => 'Maximum numbers of registrants',
	'date' => 'Date',
	'duration' => 'Duration (in days)',
	'budget' => 'Budget (in €)',
	'room_length' => 'Room length (in meters)',
	'room_width' => 'Room width (in meters)',
	'location' => 'Location',
	'' => '',
	'room_plan' => 'Room plan :',
	'legend' => 'Legend :',
	'wall' => 'Wall :',
	'table' => 'Table :',
	'computer' => 'Computer :',
	'console' => 'Console :',
	'empty_chair' => 'Empty chair :',
	'empty_space' => 'Empty space :',
	
	'viewing' => 'Viewing :',
	'' => 'Room dimensions',

	// Edit
	'update' => 'Update',
	'edit_title_lan' => 'Editing LAN ',
	'edit_profile' => 'Edit your profile',

	// Contact
	'contact_us' => 'Contact us',
	'object' => 'Object',
	'description' => 'Description',
	'attachment' => 'Attachment',
	'send' => ' Send',
	
	'logged_as' => 'Logged in as:',
	
	// Activity
	
	'create_activity' => 'Creating new Activity',
	'edit_activity' => 'Editing Activity',

	// {{ __('messages.contact_us') }}

	/**

	'Quick-Links'
	'Activities'
	'Games'
	'Tournament'
	'Tasks'
	'Materials'
	'Shoppings'
	'Players'
	'Admins'
	'Helpers'
	'Public View'

	'Helper section'
	'Admin section'

	// Shopping
	'The Shopping List for the LAN '
	'To buy'
	'Total price'
	'Budget'
	'Remaining money'
	'Cost'
	'Price'
	'Quantity'
	'Choose Material'
	'Creating new Shopping'

	// Tasks
	'No tasks to show'
	'Add a Task'

	**/
];
