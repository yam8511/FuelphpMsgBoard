<?php

class Model_Reply extends \Orm\Model
{
	protected static $_belongs_to = array('msgboard');
	protected static $_properties = array(
		'id',
		'message',
		'account_id',
		'msgboard_id',
		'created_at',
		'updated_at',
	);

	protected static $_table_name = 'replies';

	public function user($id)
	{
		$user = Model_Account::find($id);
		return $user;
	}
}
