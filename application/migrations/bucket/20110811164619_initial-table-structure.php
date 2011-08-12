<?php defined('SYSPATH') or die('No direct script access.');/**
 * Initial table structure
 */
class Migration_Bucket_20110811164619 extends Minion_Migration_Base {

	/**
	 * Run queries needed to apply this migration
	 *
	 * @param Kohana_Database Database connection
	 */
	public function up(Kohana_Database $db)
	{
		$db->query(NULL, 'CREATE TABLE `accounts` (
			`id` VARCHAR(255) NOT NULL ,
			`name` VARCHAR(255) NOT NULL ,
			`account_number` VARCHAR(255) NOT NULL ,
			`routing_number` VARCHAR(255) NOT NULL ,
			PRIMARY KEY (`id`)
			) ENGINE = INNODB;'
		);
		$db->query(NULL, 'ALTER TABLE `accounts` ADD UNIQUE (`name`)');

		$db->query(NULL, 'CREATE TABLE `transaction_categories` (
			`id` VARCHAR(255) NOT NULL ,
			`name` VARCHAR(255) NOT NULL ,
			PRIMARY KEY (`id`)
			) ENGINE = INNODB;'
		);
		$db->query(NULL, 'ALTER TABLE `transaction_categories` ADD UNIQUE (`name`)');

		$db->query(NULL, 'CREATE TABLE `transactions` (
			`id` VARCHAR(255) NOT NULL ,
			`date` INT NOT NULL ,
			`amount` DECIMAL(10, 2) NOT NULL ,
			`memo` VARCHAR(255) NOT NULL ,
			`cleared_status` CHAR(1) NOT NULL ,
			`payee` VARCHAR(255) NOT NULL ,
			`category_id` VARCHAR(255) NOT NULL ,
			`account_id` VARCHAR(255) NOT NULL ,
			PRIMARY KEY (`id`)
			) ENGINE = INNODB;'
		);
	}

	/**
	 * Run queries needed to remove this migration
	 *
	 * @param Kohana_Database Database connection
	 */
	public function down(Kohana_Database $db)
	{
		$db->query(NULL, 'DROP TABLE `accounts`');
		$db->query(NULL, 'DROP TABLE `transaction_categories`');
		$db->query(NULL, 'DROP TABLE `transactions`');
	}
}
