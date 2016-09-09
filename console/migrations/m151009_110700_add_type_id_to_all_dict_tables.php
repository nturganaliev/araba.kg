<?php

use yii\db\Schema;
use yii\db\Migration;

class m151009_110700_add_type_id_to_all_dict_tables extends Migration {

    public function safeUp() {
        $this->createTable('complete_sets_car_types', [
            'complete_set_id' => $this->integer()->notNull(),
            'car_type_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey('fk_car_type_complete_set_id', 'complete_sets_car_types', 'complete_set_id', 'complete_sets', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_complete_set_car_type_id', 'complete_sets_car_types', 'car_type_id', 'car_types', 'id', 'CASCADE', 'CASCADE');
        $this->addColumn('complete_sets', 'frequency', $this->integer()->notNull()->defaultValue(0));

        $this->createTable('engines_car_types', [
            'engine_id' => $this->integer()->notNull(),
            'car_type_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey('fk_car_type_engine_id', 'engines_car_types', 'engine_id', 'engines', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_engine_car_type_id', 'engines_car_types', 'car_type_id', 'car_types', 'id', 'CASCADE', 'CASCADE');
        $this->addColumn('engines', 'frequency', $this->integer()->notNull()->defaultValue(0));

        $this->createTable('kuzovs_car_types', [
            'kuzov_id' => $this->integer()->notNull(),
            'car_type_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey('fk_car_type_kuzov_id', 'kuzovs_car_types', 'kuzov_id', 'kuzovs', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_kuzov_car_type_id', 'kuzovs_car_types', 'car_type_id', 'car_types', 'id', 'CASCADE', 'CASCADE');
        $this->addColumn('kuzovs', 'frequency', $this->integer()->notNull()->defaultValue(0));

        $this->createTable('privods_car_types', [
            'privod_id' => $this->integer()->notNull(),
            'car_type_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey('fk_car_type_privod_id', 'privods_car_types', 'privod_id', 'privods', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_privod_car_type_id', 'privods_car_types', 'car_type_id', 'car_types', 'id', 'CASCADE', 'CASCADE');
        $this->addColumn('privods', 'frequency', $this->integer()->notNull()->defaultValue(0));

        $this->createTable('wheels_car_types', [
            'wheel_id' => $this->integer()->notNull(),
            'car_type_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey('fk_car_type_wheel_id', 'wheels_car_types', 'wheel_id', 'wheels', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_wheel_car_type_id', 'wheels_car_types', 'car_type_id', 'car_types', 'id', 'CASCADE', 'CASCADE');
        $this->addColumn('wheels', 'frequency', $this->integer()->notNull()->defaultValue(0));

        $this->createTable('transmissions_car_types', [
            'transmission_id' => $this->integer()->notNull(),
            'car_type_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey('fk_car_type_transmission_id', 'transmissions_car_types', 'transmission_id', 'transmissions', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_transmission_car_type_id', 'transmissions_car_types', 'car_type_id', 'car_types', 'id', 'CASCADE', 'CASCADE');
        $this->addColumn('transmissions', 'frequency', $this->integer()->notNull()->defaultValue(0));

        $this->createTable('colors_car_types', [
            'color_id' => $this->integer()->notNull(),
            'car_type_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey('fk_car_type_color_id', 'colors_car_types', 'color_id', 'colors', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_color_car_type_id', 'colors_car_types', 'car_type_id', 'car_types', 'id', 'CASCADE', 'CASCADE');
        $this->addColumn('colors', 'frequency', $this->integer()->notNull()->defaultValue(0));
    }

    public function safeDown() {
        $this->dropTable('complete_sets_car_types');
        $this->dropTable('engines_car_types');
        $this->dropTable('kuzovs_car_types');
        $this->dropTable('privods_car_types');
        $this->dropTable('wheels_car_types');
        $this->dropTable('transmissions_car_types');
        $this->dropTable('colors_car_types');
        $this->dropColumn('complete_sets', 'frequency');
        $this->dropColumn('engines', 'frequency');
        $this->dropColumn('kuzovs', 'frequency');
        $this->dropColumn('privods', 'frequency');
        $this->dropColumn('wheels', 'frequency');
        $this->dropColumn('transmissions', 'frequency');
        $this->dropColumn('colors', 'frequency');
    }

}
