<?php

use yii\db\Schema;
use yii\db\Migration;

class m150824_083656_create_posts_table extends Migration {

    public function safeUp() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('posts', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            ], $tableOptions);
        $this->createTable('mposts', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'lang' => $this->string()->notNull(),
            'title' => $this->string(255),
            'body' => $this->text(),
            'created_by' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            ], $tableOptions);
        $this->addForeignKey('fk_mposts_post_id_posts_id', 'mposts', 'post_id', 'posts', 'id', 'CASCADE', 'CASCADE');
        $this->createIndex('uniq_mposts_post_id_lang', 'mposts', ['post_id', 'lang'], true);
    }

    public function safeDown() {
        $this->dropTable('mposts');
        $this->dropTable('posts');
    }

}
