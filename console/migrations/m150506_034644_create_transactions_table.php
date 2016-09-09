<?php

use yii\db\Schema;
use yii\db\Migration;

class m150506_034644_create_transactions_table extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('transactions', [
            'id' => Schema::TYPE_PK,
            'client_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'employee_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'amount' => Schema::TYPE_STRING . '(255) NOT NULL',
            'type' => Schema::TYPE_BOOLEAN . ' not null',
            'description' => Schema::TYPE_STRING,
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL'
            ], $tableOptions);
    }

    public function safeDown() {
        $this->dropTable('transactions');
    }

}
