<?php

use yii\db\Schema;
use yii\db\Migration;

class m151126_020954_add_lang_fieldToUserProfile_table extends Migration {

    public function safeUp() {
        $this->addColumn('users_profiles', 'lang', $this->string(10)->defaultValue('ru'));
    }

    public function safeDown() {
        $this->dropColumn('users_profiles', 'lang');
    }

}
