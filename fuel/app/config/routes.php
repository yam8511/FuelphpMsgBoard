<?php
return array(
	'_root_'  => 'msgboard/index',  // The default route
	'_404_'   => 'msgboard/404',    // The main 404 route
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),

	'home' => 'msgboard/index',

	'add' =>'msgboard/add',

	'edit_msg' =>'msgboard/editMessage',

	'del_msg' => 'msgboard/deleteMessage',

	'edit_rpl' =>'reply/editReply',

	'del_rpl' => 'reply/deleteReply',

	'reply' => 'reply/addReply',

	'belong' => 'msgboard/belongUser',

	'register' => 'account/register',

	'login' => 'account/login',

	'logout' => 'account/logout'
);
