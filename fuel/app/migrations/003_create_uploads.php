<?php

namespace Fuel\Migrations;

class Create_uploads
{
	public function up()
	{
		\DBUtil::create_table('uploads', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' => array('constraint' => 255, 'type' => 'varchar'),
			'extension' => array('constraint' => 50, 'type' => 'varchar'),
			'saved_as' => array('constraint' => 255, 'type' => 'varchar'),
			'saved_to' => array('constraint' => 255, 'type' => 'varchar'),
			'msgboard_id' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('uploads');
	}
}