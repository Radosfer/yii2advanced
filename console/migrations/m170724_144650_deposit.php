<?php

use yii\db\Migration;

class m170724_144650_deposit extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('deposit', [
            'id' => $this->primaryKey(),
            'house_id' => $this->integer(11)->notNull(),
            'date' => $this->char(255)->notNull(),
            'purpose' => $this->char(255)->notNull(),
            'amount' => $this->float()->notNull(),
            'garden_id' => $this->integer(11)->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        echo "m170724_144650_deposit cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
