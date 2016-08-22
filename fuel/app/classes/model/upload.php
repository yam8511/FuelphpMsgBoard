<?php

class Model_Upload extends \Orm\Model
{
	protected static $_belongs_to = array('msgboard');
	protected static $_properties = array(
		'id',
		'name',
		'extension',
		'saved_as',
		'saved_to',
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

	protected static $_table_name = 'uploads';

}
