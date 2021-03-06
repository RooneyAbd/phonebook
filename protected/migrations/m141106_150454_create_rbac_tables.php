<?php

class m141106_150454_create_rbac_tables extends CDbMigration
{
	public function up()
	{
	$this->createTable('auth_item', array(
	'name'=>'varchar(64) NOT NULL',
	'type'=>'integer NOT NULL',
	'description'=>'text',
	'bizrule'=>'text',
	'data'=>'text',
	'PRIMARY KEY(`name`)',
	), 'ENGINE=InnoDB');
	
	$this->createTable('auth_item_child', array(
	'parent'=>'varchar(64) NOT NULL',
	'child'=>'varchar(64) NOT NULL',
	'PRIMARY KEY(`parent`, `child`)',
	), 'ENGINE=InnoDB');
	
	$this->addForeignKey("fk_auth_item_child_parent", "auth_item_child", "parent", "auth_item", "name", "CASCADE", "CASCADE");
	
	$this->addForeignKey("fk_auth_item_child", "auth_item_child", "child", "auth_item", "name", "CASCADE", "CASCADE");
	$this->createTable('auth_assignment', array(
	'itemname'=>'varchar(64) NOT NULL',
	'userid'=>'int(11)NOT NULL',
	'bizrule'=>'text',
	'data'=>'text',
	'PRIMARY KEY(`itemname`, `userid`)',
	), 'ENGINE=InnoDB');
	
	$this->addForeignKey(
	"fk_auth_assignment_itemname",
	"auth_assignment",
	"itemname",
	"auth_item",
	"name",
	"CASCADE",
	"CASCADE"
	);
	
	$this->addForeignKey(
	"fk_auth_assignment_user_id",
	"auth_assignment",
	"userid",
	"users",
	"user_id",
	"CASCADE",
	"CASCADE"
	);
	}

	public function down()
	{
		$this->truncateTable('auth_assignment');
		$this->truncateTable('auth_item_child');
		$this->dropTable('auth_assignment');
		$this->dropTable('auth_item_child');
		$this->dropTable('auth_item');
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