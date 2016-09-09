<?php

use yii\db\Schema;
use yii\db\Migration;

class m150507_233826_create_premiums_table extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('premiums_logs', [
            'id' => Schema::TYPE_PK,
            'car_id' => Schema::TYPE_BIGINT . ' NOT NULL',
            'tarrif_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'premium_begin' => Schema::TYPE_DATETIME . ' NOT NULL',
            'premium_end' => Schema::TYPE_DATETIME . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL'
            ], $tableOptions);
    }

    public function safeDown() {
        $this->dropTable('premiums_logs');
    }

}
