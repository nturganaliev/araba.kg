<?php

use yii\db\Schema;
use yii\db\Migration;

class m150406_051153_create_comments_table extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('comments', [
            'id' => Schema::TYPE_BIGPK,
            'car_id' => Schema::TYPE_BIGINT . ' NOT NULL',
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'message' => Schema::TYPE_STRING,
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL'
            ], $tableOptions);
    }

    public function safeDown() {
        $this->dropTable('comments');
    }

}
