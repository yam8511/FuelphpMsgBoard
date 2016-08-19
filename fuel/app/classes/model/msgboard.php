<?php

class Model_Msgboard extends \Orm\Model
{
	protected static $_belongs_to = array('account');
	protected static $_has_one = array('upload');
	protected static $_has_many = array('replies');

	protected static $_properties = array(
		'id',
		'title',
		'message',
		'account_id',
		'created_at',
		'updated_at',
	);

	protected static $_table_name = 'msgboards';
/*
	public function replies($id)
	{
		$replies = Model_Reply::find('all',[
			'where' => [ 'msgboard_id' => $id ]
		]);
		return $replies;
	}
*/
	public function username($id)
	{
		$user = Model_Account::find($id);
		if($user) {
			return $user->name;
		} else {
			return 'Guest';
		}
	}

}
