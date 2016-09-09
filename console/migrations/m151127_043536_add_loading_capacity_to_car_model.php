<?php

use yii\db\Schema;
use yii\db\Migration;

class m151127_043536_add_loading_capacity_to_car_model extends Migration {

    public function safeUp() {
        $this->addColumn('cars', 'loading_capacity', $this->float());
    }

    public function safeDown() {
        $this->dropColumn('cars', 'loading_capacity');
    }

}
