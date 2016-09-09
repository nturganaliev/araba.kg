<?php

use yii\db\Schema;
use yii\db\Migration;

class m150504_023135_create_tarrifs_table extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('tarrifs', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'day_count' => Schema::TYPE_INTEGER . '(255) NOT NULL',
            'price' => Schema::TYPE_DECIMAL . '(16,2) not null',
            'description' => Schema::TYPE_STRING . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL'
            ], $tableOptions);
    }

    public function safeDown() {
        $this->dropTable('tarrifs');
    }

}
