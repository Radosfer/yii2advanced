<?php

use yii\db\Migration;

class m170704_164026_house extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('house', [
            'id' => $this->primaryKey(),
            'street_id' => $this->integer(11)->notNull(),
            'group_id' => $this->integer(11)->notNull(),
            'title' => $this->char(255)->notNull(),
            'fio' => $this->char(255)->notNull(),
            'phone' => $this->char(255)->notNull(),
            'money' => $this->float()->notNull(),
            'testimony' => $this->integer(11)->notNull(),
            'start_value' => $this->integer(11)->notNull(),
            'last_indication' => $this->integer(11)->notNull(),
            'spent' => $this->integer(11)->notNull(),
            'garden_id' => $this->integer(11)->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        echo "m170704_164026_house cannot be reverted.\n";

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
