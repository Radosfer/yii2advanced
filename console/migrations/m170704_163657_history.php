<?php

use yii\db\Migration;

class m170704_163657_history extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('history', [
            'id' => $this->primaryKey(),
            'house_id' => $this->integer(11)->notNull(),
            'date' => $this->char(255)->notNull(),
            'pay' => $this->float()->notNull(),
            'testimony' => $this->integer(11)->notNull(),
            'tariff' => $this->float()->notNull(),
            'money' => $this->float()->notNull(),
            'start_indication' => $this->integer(11)->notNull(),
            'garden_id' => $this->integer(11)->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        echo "m170704_163657_history cannot be reverted.\n";

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
