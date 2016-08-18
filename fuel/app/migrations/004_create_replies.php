<?php

namespace Fuel\Migrations;

class Create_replies
{
	public function up()
	{
		\DBUtil::create_table('replies', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'message' => array('type' => 'text'),
			'account_id' => array('constraint' => 11, 'type' => 'int'),
			'msgboard_id' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('replies');
	}
}