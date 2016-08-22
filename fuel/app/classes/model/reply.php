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

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => true,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => true,
		),
	);

	protected static $_table_name = 'replies';

	public function user($id)
	{
		$user = Model_Account::find($id);
		return $user;
	}
}
