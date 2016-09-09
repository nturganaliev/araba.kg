<?php

use yii\db\Schema;
use yii\db\Migration;

class m150224_055509_create_uploads_table extends Migration {

    public function up() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('images', [
            'id' => Schema::TYPE_BIGPK,
            'car_id' => Schema::TYPE_BIGINT . ' NOT NULL',
            'filename' => Schema::TYPE_STRING . ' NOT NULL',
            'extension' => Schema::TYPE_STRING . ' NOT NULL',
            'is_main' => Schema::TYPE_BOOLEAN
            ], $tableOptions);
    }

    public function down() {
        $this->dropTable('images');
    }

}
