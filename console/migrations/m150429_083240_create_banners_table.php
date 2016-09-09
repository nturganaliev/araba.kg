<?php

use yii\db\Schema;
use yii\db\Migration;

class m150429_083240_create_banners_table extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('banners', [
            'id' => Schema::TYPE_BIGPK,
            'page' => Schema::TYPE_BIGINT . ' NOT NULL',
            'image' => Schema::TYPE_STRING . '(255) NOT NULL',
            'url' => Schema::TYPE_STRING,
            'position' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL'
            ], $tableOptions);
    }

    public function safeDown() {
        $this->dropTable('banners');
    }

}
