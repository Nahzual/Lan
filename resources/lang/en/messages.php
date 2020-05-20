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
	'site_user' => 'Site Users',
	'user_page' => 'User page',

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

	'homestats' => 'The latest LAN was created on :date with :reg / :maxreg registrants !',
	'homejoin' => 'Sign-in now to create your first LAN !',


	'name' => 'Name',
	'lname' => 'Last Name',
	'username' => 'Username',
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
	'user_admin_lan_current' => '{0} This user isn\'t an admin on any LAN currently |{1} This user is currently administrating :count lan|[2,*] This user is currently administrating :count lans',
	'user_helper_lan_current' => '{0} This user isn\'t an helping on any LAN currently |{1} This user is currently helping on :count lan|[2,*] This user is currently helping on :count lans',
	'user_player_lan_current' => '{0} This user isn\'t planning on playing in any LAN currently |{1} This user is planning to play in :count lan|[2,*] This user is planning to play in :count lans',
	'user_admin_lan' => '{0} This user hasn\'t been an admin on any LAN yet |{1} This user has been administrating :count lan so far|[2,*] This user has been administrating :count lans so far',
	'user_helper_lan' => '{0} This user hasn\'t helped on any LAN yet |{1} This user has helped on :count lan so far|[2,*] This user has helped on :count lans so far',
	'user_player_lan' => '{0} This user hasn\'t played in any LAN yet |{1} This user has played in :count lan so far |[2,*] This user has played in :count lans so far',

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
	'accept' => 'Accept',
	'reject' => 'Reject',
	'remove' => 'Remove',


	'admin_lan' => 'All the admins for the LAN ',
	'add_new_admin' => 'Add a new Admin',
	'adding_admin_lan' => 'Adding admin to Lan :',
	'admin_name' => 'Admin\'s name :',

	'helper_lan' => 'All the helpers for the LAN ',
	'add_new_helper' => 'Add a new Helper',
	'adding_helper_lan' => 'Adding helper to LAN :',
	'helper_name' => 'Helper\'s name :',

	'add_new_game' => 'Add a new game',
	'add_new_material' => 'Add a new material',

	'back_home' => ' Go back to the home page',
	'back_lan' => ' Go back to the LAN',
	'back_dashboard' => ' Go back to the dashboard',
	'back_game' => 'Return to the game list',

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
	'all_users' => 'Manage users',
	'all_tournaments' => 'Manage tournaments',
	'all_materials' => 'Manage materials',

	'no_lans' =>'No LANs to show',
	'no_users'=>'No users to show',
	'no_games'=>'No games to show',
	'no_games2'=> 'What\'s gaming, doc ?',
	'no_games3'=> 'Your game is in another castle...',
	'latest_users' => 'Latest users',
	'latest_deleted_users' => 'Latest deleted users',

	'pending_lans' => 'Pending LANs',

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
	'update' => ' Save changes',
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

	'verify_email' => 'Verify Your Email Address',
	'verif_link_sent' => 'A fresh verification link has been sent to your email address.',
	'check_email' => 'Before proceeding, please check your email for a verification link.',
	'not_get' => 'If you did not receive the email',
	'click_request_another' => 'click here to request another',

	// Errors
	'error_404' => '404 Error',
	'error_404_message' => 'The page you attempted to reach is not registered.',
	'error_500' => '500 error',
	'error_500_message' => 'The server encountered a fatal error. Please, contact the website\'s admin',
	
	// Ports
	'add_port_game_lan' => 'Adding port to game ":game" for LAN :lan',
	'add_port_game' => 'Adding port to game ":game"',
	'port' => 'Port :',
	
	// games
	'release_date' => 'Release date',
	'price' => 'Price (in €) ',
	'game_type' => 'Game type',
	'solo' => '1 player',
	'multi_local' => 'Local multiplayer',
	'Online multiplayer',
	'used_ports' => 'Used ports',
	'ports' => 'Ports',
	'my_fav' => 'My precious',
	'find_new_games' => 'Find new games',
	'mark' => 'Mark',
	'unmark' => 'Unmark',
	'create_new_game' => 'Create a new game',
	'add_game' => 'Add game',
	'game' => 'Game',
	
	// team
	'add_players' => 'Add players',
	'add_users' => 'Add users',
	'nbr_members' => 'Number of member',
	'member' => 'Member',
	'join_tournament' => 'Join tournament',
	'join' => 'Join',
	'no_players' => 'No Participants for the moment',
	'no_players2' => 'No players to show',
	'delete_participation' => 'Delete participation',
	'create_new_team' => 'Creating new Team',
	'back_tournament' => 'Go Back to Tournament',
	'team_name' => 'Name of team :',
	'team_members'=> 'Team players',
	'all_players_team' => 'All the players of the team ',
	'cannot_create_team_solo' => 'You can\'t create teams for this tournament, as the match mode of this tournament is solo.',
	
	// Account deletion
	
	'account_deletion' => 'Account deletion',
	'confirm_wish_delete' => 'Do you really want to delete your account ?',
	'deletion_consequence' => 'You will no longer be able to log in to your account after this operation.',
	'deletion_option' => 'You have two options to delete your account : you can either disable your account, or permanently delete it.',
	'deletion_option_explanation' => 'In the first case only, you can recover your account by contacting an administrator using the "Contact" page. You will have to remember at least the email address associated with this account.',
	'deletion_recovery' => 'Be careful, you will also have to prove that you still have access to this email address.',
	'proceed' => 'Proceed ?',
	'disable_account' => 'Disable your account',
	'delete_account' => 'Delete your account',
	
	// Tasks
	'task_page' =>'Task page',
	'viewing_task' =>'Viewing task ',
	'' => 'No tasks to show' ,
	'' => 'Add a Task',
	'helper_task' => 'Helpers in charge of this task :',
	'deadline' => 'Deadline',
	'my_tasks_lan' => 'My tasks for LAN :',
	'no_tasks' => 'Nothing to do, nothing to show',
	'create_new_task' => 'Creating new task',
	'back_tasklist' => 'Go to your tasklist',
	'adding_helper_task' => 'Adding helper to Task',
	'editing_task' => 'Editing Task',
	'assign_to_helper' => 'Assign to an helper',
	
	// echo __('messages.welcome', ['name' => 'dayle']);
	//'welcome' => 'Welcome, :NAME', // Welcome, DAYLE
	//'goodbye' => 'Goodbye, :Name', // Goodbye, Dayle
	//{{ __('messages.add_port_game', ['game' => $game->name_game, 'lan' => $lan->name]) }}
	
	// {{ __('messages.') }}

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
	**/
	
	/**
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
	**/
	

];
