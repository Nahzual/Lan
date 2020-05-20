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


// {{ __('messages.') }}

	'lan_act'=>'LAN\'s activities',
	'all_act_lan' => 'All activities for the LAN',
	'add_activity' => 'Add an activity',
	
	'lan_admin'=>'LAN\'s admins',
	'all_admin_lan' => 'All the admins for the LAN',
	'add_admin' => 'Add a new admin',
	
	'lan_task'=>'LAN\'s tasks',
	'all_task_lan' => 'All the tasks for the LAN',
	'add_task' => 'Add a new task',
	'assign' => 'Assign',
	
	'lan_shopping'=>'LAN\'s shopping',
	'all_shopping_lan' => 'The Shopping List for the LAN ',
	'no_shoppings' => 'No shopping to show',
	
	'lan_game'=>'LAN\'s games',
	'all_game_lan' => 'All the games for the LAN',
	
	'login_required'=>'Log-in required',
	'account_needed'=>'You must have an account to participate to LANs or create one.',
	'cannot_see_info_lan'=>'You also won\'t be able to see all the informations about this LAN',
	'reminder'=>'Reminder',
	'external_users'=>'LANs are managed by external Users',
	'be_careful'=>'Please, be careful and never leak your credentials',
	'even_friend'=>'(even to a "close" friend)',
	'can_make_lan'=>'If you desire, you can also create your own LAN !',
	'lan_closed'=>'LAN closed',
	'join_lan'=>'Join this LAN',

	'chln' => ' Changer la Langue',
	'site_user' => 'Site Users',
	'user_page' => 'User page',

	// Menu

	'find_lan' => 'Trouver une LAN',
	'contact' => 'Contact',
	'login' => 'Connexion',
	'register' => 'Inscription',
	'logout' => 'Deconnexion',
	'remember_me' => 'Se souvenir de moi',
	'forgot_password' => 'Mot de passe oublié ?',
	'reset_password' => 'Reinitialiser le mot de passe',
	'send_reset_link' => 'Send Password Reset Link',
	'confirm_password_before' => 'Please confirm your password before continuing.',

	'lan_creator' => 'LAN Creator',


	// Home
	'home' => 'Accueil',
	'hometitle' => 'Creez votre LAN dès maintenant !',
	'home_p1t' => 'Choisissez vos jeux',
	'home_p1' => 'Link your Games to your LAN, review the connexion ports and choose your must-haves with our "fav" system ! You might even find some new ones...',
	'home_p2t' => 'Host unique Activities ',
	'home_p2' => 'Create heavily-customised tournaments, define what your own LAN is and more ! With our room mapping application, you also can see how everyone can fit !',
	'home_p3t' => 'Organization is key ',
	'home_p3' => 'Don\'t do it alone ! Add helpers, news admins, deploy tasks, define a shopping list and a to-do list to avoid some last-minute expenses !',

	'homestats' => 'The latest LAN was created on :date with :reg / :maxreg registrants !',
	'homejoin' => 'Sign-in now to create your first LAN !',


	'name' => 'Nom',
	'lname' => 'Last Name',
	'username' => 'Username',
	'pseudo' => 'Pseudo',
	'email' => 'Adresse e-Mail',
	'tel' => 'Numero de téléphone ',
	'password' => 'Mot de passe',
	'confirmpassword' => 'Confirmer le mot de passe',
	'streetnbr' => 'Numero de rue',
	'streetname' => 'Rue',
	'city' => 'Ville',
	'zip' => 'Zip',
	'depname' => 'Department',
	'country' => 'Pays',
	'address' => 'Adresse',

	'want_contact' => 'If you want to contact this user, please use the "Contact" button and wait for his reply on your mailbox.',

	// Stats
	'statistics' => 'Statistics',
	'user_admin_lan' => '{0} Cet utilisateur n\'est un admin sur aucune LAN pour le moment |{1} This user is currently administrating :count lan|[2,*] This user is currently administrating :count lans',
	'user_helper_lan_current' => '{0} This user isn\'t an helping on any LAN currently |{1} This user is currently helping on :count lan|[2,*] This user is currently helping on :count lans',
	'user_player_lan_current' => '{0} This user isn\'t planning on playing in any LAN currently |{1} This user is planning to play in :count lan|[2,*] This user is planning to play in :count lans',
	'user_admin_lan' => '{0} This user hasn\'t been an admin on any LAN yet |{1} This user has been administrating :count lan so far|[2,*] This user has been administrating :count lans so far',
	'user_helper_lan' => '{0} This user hasn\'t helped on any LAN yet |{1} This user has helped on :count lan so far|[2,*] This user has helped on :count lans so far',
	'user_player_lan' => '{0} This user hasn\'t played in any LAN yet |{1} This user has played in :count lan so far |[2,*] This user has played in :count lans so far',

	//echo trans_choice('time.minutes_ago', 5, ['value' => 5]);


	// Dashboard
	'chtheme' => 'Changer le Theme',
	'settings' => 'Parametres',
	'view' => 'Voir',
	'edit' => 'Edit',
	'delete' => 'Supprimer',
	'ban' => 'Ban',
	'restore' => 'Restore',
	'show_hide' => 'Afficher/cacher',
	'all' => 'Tous',


	'add' => 'Ajouter',
	'actions' => 'Actions',
	'nohelper' => 'No helpers to show',
	'helpers' => 'Helpers',
	'admins' => 'Admins',
	'nouser' => 'No users to show',
	'first' => 'First',
	'back' => 'Précédent',
	'next' => 'Suivant',
	'last' => 'Last',
	'search' => 'Rechercher',
	'back_admin_dash' => 'Return to the admin Dashboard',
	'accept' => 'Accepter',
	'reject' => 'Rejeter',
	'remove' => 'Retirer',


	'admin_lan' => 'All the admins for the LAN ',
	'add_new_admin' => 'Add a new Admin',
	'adding_admin_lan' => 'Ajouter un admin a la LAN :',
	'admin_name' => 'Nom de l\'admin :',

	'helper_lan' => 'All the helpers for the LAN ',
	'add_new_helper' => 'Add a new Helper',
	'adding_helper_lan' => 'Ajouter un helper a la LAN :',
	'helper_name' => 'nom du helper :',

	'add_new_game' => 'Add a new game',
	'add_new_material' => 'Add a new material',

	'back_home' => ' Retour a la page d\'accueil',
	'back_lan' => ' Retourner a la LAN',
	'back_dashboard' => ' Retourner au dashboard',
	'back_game' => 'Return to the game list',

	'participants' => 'Participants',
	'state' => 'State',
	'quit' => 'Quit',

	'navigation' =>'Navigation',
	'dashboard' =>'Tableau de bord',
	'lan' =>'LAN',
	'all_lans' =>'Toutes les LANs',
	'my_tasks' =>'Mes tâches',

	'games' =>'JEUX',
	'all_games' =>'Tous les jeux',
	'my_games' =>'Mes jeux',

	'admin' => 'ADM',
	'admin_dashboard' => 'Tableau de bord admin',
	'all_users' => 'Gérer les utilisateurs',
	'all_tournaments' => 'Gérer les tournois',
	'all_materials' => 'Gérer le matériel',

	'no_lans' =>'Aucune LAN à afficher',
	'no_users'=>'No users to show',
	'no_games'=>'No games to show',
	'no_games2'=> 'What\'s gaming, doc ?',
	'no_games3'=> 'Your game is in another castle...',
	'latest_users' => 'Latest users',
	'latest_deleted_users' => 'Latest deleted users',

	'pending_lans' => 'Pending LANs',

	'my_lans' =>'Mes LANs',
	'my_lans_helper' =>'LANs sur lesquelles j\'aide',
	'my_lans_player' =>'LANs auxquelles je joue',

	'create_new_lan' =>'Creer une nouvelle LAN',

	// LAN

	'nb_max_registrants' => 'Nombre maximum de participants',
	'date' => 'Date ',
	'duration' => 'Durée (en jours)',
	'budget' => 'Budget (in €)',
	'room_length' => 'Longeur de la salle (en mètres)',
	'room_width' => 'Largeur de la salle (en mètres)',
	'location' => 'Adresse',
	'' => '',
	'room_plan' => 'Plan de la salle :',
	'legend' => 'Legende :',
	'wall' => 'Mur :',
	'table' => 'Table :',
	'computer' => 'Ordinateur :',
	'console' => 'Console :',
	'empty_chair' => 'chaise libre :',
	'empty_space' => 'Espace libre :',

	'viewing' => 'Viewing :',
	'room_dim' => 'Room dimensions',

	// Edit
	'update' => 'Sauvegarder',
	'edit_title_lan' => 'Editing LAN ',
	'edit_profile' => 'Edit your profile',

	// Contact
	'contact_us' => 'Nous Contacter',
	'object' => 'Object',
	'description' => 'Description',
	'attachment' => 'Piece jointe',
	'send' => ' Envoyer',

	'logged_as' => 'Logged in as:',

	// Activity

	'create_activity' => 'Creating new Activity',
	'edit_activity' => 'Editing Activity',

	'verify_email' => 'Verify Your Email Address',
	'verif_link_sent' => 'A fresh verification link has been sent to your email address.',
	'check_email' => 'Before proceeding, please check your email for a verification link.',
	'not_get' => 'If you did not receive the email',
	'click_request_another' => 'click here to request another',
	'no_activities' => 'No activities to show',

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
	'add_task' => 'Add a Task',
	'helper_task' => 'Helpers in charge of this task :',
	'deadline' => 'Deadline',
	'my_tasks_lan' => 'My tasks for LAN :',
	'no_tasks' => 'Nothing to do, nothing to show',
	'create_new_task' => 'Creating new task',
	'back_tasklist' => 'Go to your tasklist',
	'adding_helper_task' => 'Adding helper to Task',
	'editing_task' => 'Editing Task',
	'assign_to_helper' => 'Assign to an helper',

	// material
	'materials' => 'Materials',
	'edit_material' => 'Editing Material',
	'category' => 'Category',
	'create_new_materials' => 'Creating new Material',
	'multiple_cat' => 'You can enter several categories by spacing them out with a delimiter of your choice (comma, white space...)',
	'material_name_or_cat' => 'Material\'s name or category :',
	'no_materials' => 'No materials to show',
	'add_material' => 'Add material',
	'edit_quantity' => 'Edit quantity',

	// Shopping
	'' => 'The Shopping List for the LAN',
	'to_buy' => 'To buy',
	'total_price' => 'Total price',
	'remaining_money' => 'Remaining money',
	'cost' => 'Cost',
	'quantity' => 'Quantity',
	'choose_material' => 'Choose Material',
	'edit_shopping' => 'Editing Shopping',
	'create_new_shopping' => 'Creating new Shopping',
	'add_shopping' => 'Add shopping',
	'viewing_shopping_lan' => 'Viewing shopping list element of',
	
	// tournament
	'add_to_tournament' => 'Add to tournament',
	'add_player_tournament' => 'Add players to tournament',
	'all_tourn' => 'All Tournaments',
	'hour' => 'Hour',
	'no_tournaments' => 'No tournaments to show',
	'create_new_tournament' => 'Creating new Tournament',
	'tournament_description' => 'Description of tournament',
	'tournament_name' => 'Name of tournament',
	'max_nb_player' => 'Maximum number of players',
	'tournament_mode' => 'Mode of tournament',
	'solo' =>  'Solo',
	'teams' => 'Teams',
	'choose_game' => 'Choose the game :',
	'nb_players_team' => 'Number of players per team',
	'nb_players' => 'Number of players',
	'edit_tournament' => 'Editing Tournament',
	'tournament_state' => 'State of tournament :',
	'tournament_page' => 'Tournament_page',
	
	'teams_for_tournament' => 'All teams for the tournament',
	'tournament_teams' => 'Tournament\'s teams',
	'add_team' => 'Add a team',
	'about' => 'About',
	'tree' => 'Tree',
	
	'add_player' => 'Add a new player',
	
	// notification
	
	// added as admin
	'visit_dashboard' => 'Visit your dashboard or LAN list to see everything you can do.',
	'added_as_admin' => 'You have been added as admin on',
	'added_as_admin_by' => 'by :Name :Lastname Your can now edit and delete this LAN, and add admins and helpers to it.',
	'added_as_admin_mistake' => 'If you think this might be a mistake, you can contact the LAN admin who added you on :email .',
	
	// added as helper
	'added_as_helper' => 'You have been added as helper on',
	'added_as_helper_by' => 'by :name :lastname . You can now create tasks for this LAN and edit its shopping list.',
	'added_as_helper_mistake' => 'If you think this might be a mistake, you can contact the LAN admin who added you on :email .',
	
	// removed from helper
	'removed_from_helper' => 'You have been removed from the helper list of',
	'removed_from_helper_by' => 'by :name :lastname . Your can no longer create tasks for this LAN or edit its shopping list.',
	'removed_from_helper_mistake' => 'If you think this might be a mistake, you can contact the LAN admin on :email .',
	
	// contact
	'tried_contact' => ' :name :lastname :pseudo tried to contact you using our website. If you want, you can reply at :email',
	'tried_contact_mistake' => 'If you think this is a mistake, you can ignore this message.',
	'tried_contact_spam' => 'If you feel like this user is spamming you, or causing you any type of trouble, you can contact a site administrator using the "Contact" page. Feel free to include screenshots, or any other file that can make us better understand your issue.',
	
	// lan accepted/rejected
	'your_lan' => 'Your LAN',
	'rejected' => 'has been rejected, please edit its informations before submitting it again.',
	'accepted' => ' has been accepted ! Players can now join it from the "All lans" page.',
	
	// player removed
	'player_removed' => 'You are no longer registered to the LAN ',
	'player_removed_p2' => 'because the place you choosed is no longer available.',
	'player_removed_retry' => 'You will have to choose an other place, but you can still join this LAN on the home page if there are places left.',
	
	// ban
	'game_over' => 'You have been banned from LanCreator by an administrator. You can no longer log on our website.',
	'ban_mistake' => 'If you think this is a mistake, please reply to this mail. Don\'t forget to mention the reasons why you think that you didn\'t deserve to be banned from LanCreator.',
	
	
	// echo __('messages.welcome', ['name' => 'dayle']);
	//'welcome' => 'Welcome, :NAME', // Welcome, DAYLE
	//'goodbye' => 'Goodbye, :Name', // Goodbye, Dayle
	//{{ __('messages.add_port_game', ['game' => $game->name_game, 'lan' => $lan->name]) }}
	
	// {{ __('messages.') }}

	'quick_link' => 'Quick-Links',
	'activities' => 'Activities',
	'gamess' => 'Games',
	'Tournament' => 'Tournament',
	'tournaments' => 'Tournaments',
	'tasks' => 'Tasks',
	'shoppings' => 'Shoppings',
	'players' => 'Players',

	'public_view' => 'Public View',
	'helper_section' => 'Helper section',
	'admin_section' => 'Admin section',


];
