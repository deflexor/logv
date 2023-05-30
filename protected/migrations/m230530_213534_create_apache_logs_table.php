<?php

class m230530_213534_create_apache_logs_table extends CDbMigration
{

	public function up()
    {
        $this->createTable('apache_logs', array(
            'id' => 'pk',
            'user' => 'string NOT NULL',
            'request' => 'string NOT NULL',
            'ip' => 'string NOT NULL',
            'status' => 'text',
            'size' => 'ineger',
            'timestamp' => 'datetime',
        ));
    }

    public function down()
    {
        $this->dropTable('apache_logs');
    }

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}