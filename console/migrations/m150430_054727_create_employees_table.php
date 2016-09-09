<?php

use yii\db\Schema;
use yii\db\Migration;

class m150430_054727_create_employees_table extends Migration {

    public function up() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('offices', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(255) NOT NULL UNIQUE',
            'address' => Schema::TYPE_STRING,
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);
        $this->insert('offices', [
            'name' => 'Бишкек',
            'address' => 'г. Бишкек, Кыргызстан',
            'created_at' => 1430182589,
            'updated_at' => 1430182589,
            'created_by' => 1,
            'updated_by' => 1
        ]);

        $this->createTable('employees', [
            'id' => Schema::TYPE_PK,
            'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
            'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING,
            'email' => Schema::TYPE_STRING . ' unique NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);
        $this->insert('employees', [
            'auth_key' => 'MYgzD1l8l84iwMELlgugNZw2gytza5mf',
            'password_hash' => '$2y$13$S1lGJ8dtt8EaFF9oobSd7.jvjew6e.SHil4QuO21erpcj6reJza/S',
            'password_reset_token' => null,
            'email' => 'asanjarbek@gmail.com',
            'status' => 10,
            'created_at' => 1430182589,
            'updated_at' => 1430182589,
            'created_by' => 1,
            'updated_by' => 1
        ]);

        $this->createTable('employee_profiles', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER,
            'office_id' => Schema::TYPE_INTEGER,
            'fio' => Schema::TYPE_STRING . '(100) NOT NULL',
            'phone' => Schema::TYPE_STRING . '(20) NOT NULL',
            'role' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);
        $this->insert('employee_profiles', [
            'user_id' => 1,
            'office_id' => 1,
            'fio' => 'Аматов Санжарбек Алишович',
            'phone' => '+996 700 106940',
            'role' => 0,
            'created_at' => 1430182589,
            'updated_at' => 1430182589,
            'created_by' => 1,
            'updated_by' => 1
        ]);
    }

    public function down() {
        $this->dropTable('employees');
        $this->dropTable('employee_profiles');
        $this->dropTable('offices');
    }

}
