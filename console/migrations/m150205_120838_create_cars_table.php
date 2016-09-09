<?php

use yii\db\Schema;
use yii\db\Migration;

class m150205_120838_create_cars_table extends Migration {

    public function up() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('car_types', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);
        $this->insert('car_types', ['name' => 'Автомобиль', 'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('car_types', ['name' => 'Грузовик', 'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('car_types', ['name' => 'Автобусы', 'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('car_types', ['name' => 'Спец. техника', 'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('car_types', ['name' => 'Мото техника', 'created_by' => 1, 'updated_by' => 1,]);

        $this->createTable('markas', [
            'id' => Schema::TYPE_PK,
            'car_type_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);
        $this->insert('markas', ['car_type_id' => 1, 'name' => 'Acura', 'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('markas', ['car_type_id' => 1, 'name' => 'Alfa Romeo', 'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('markas', ['car_type_id' => 1, 'name' => 'Aston Martin', 'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('markas', ['car_type_id' => 1, 'name' => 'Audi', 'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('markas', ['car_type_id' => 1, 'name' => 'Bentley', 'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('markas', ['car_type_id' => 1, 'name' => 'BMW', 'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('markas', ['car_type_id' => 1, 'name' => 'Bugatti', 'created_by' => 1, 'updated_by' => 1,]);

        $this->createTable('car_models', [
            'id' => Schema::TYPE_PK,
            'marka_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'seria' => Schema::TYPE_INTEGER,
            'is_seria' => Schema::TYPE_BOOLEAN,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);
        $this->insert('car_models', [
            'marka_id' => 1, 'seria' => NULL, 'is_seria' => false, 'name' => 'Integra',
            'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('car_models', [
            'marka_id' => 1, 'seria' => NULL, 'is_seria' => false, 'name' => 'MDX',
            'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('car_models', [
            'marka_id' => '2', 'seria' => NULL, 'is_seria' => false, 'name' => '8C',
            'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('car_models', [
            'marka_id' => '2', 'seria' => NULL, 'is_seria' => false, 'name' => 'Alfa 145',
            'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('car_models', [
            'marka_id' => '3', 'seria' => NULL, 'is_seria' => false, 'name' => 'AR1',
            'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('car_models', [
            'marka_id' => '3', 'seria' => NULL, 'is_seria' => false, 'name' => 'Cygnet',
            'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('car_models', [
            'marka_id' => '4', 'seria' => NULL, 'is_seria' => false, 'name' => '80',
            'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('car_models', [
            'marka_id' => '4', 'seria' => NULL, 'is_seria' => false, 'name' => 'A6',
            'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('car_models', [
            'marka_id' => '5', 'seria' => NULL, 'is_seria' => false, 'name' => 'Arnage',
            'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('car_models', [
            'marka_id' => '6', 'seria' => NULL, 'is_seria' => true, 'name' => 'Series 1',
            'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('car_models', [
            'marka_id' => '6', 'seria' => 10, 'is_seria' => false, 'name' => '114',
            'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('car_models', [
            'marka_id' => '6', 'seria' => 10, 'is_seria' => false, 'name' => '116',
            'created_by' => 1, 'updated_by' => 1,]);
        $this->insert('car_models', [
            'marka_id' => '6', 'seria' => NULL, 'is_seria' => false, 'name' => '840',
            'created_by' => 1, 'updated_by' => 1,]);

        $this->createTable('wheels', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);
        $this->insert('wheels', ['name' => 'Левый', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('wheels', ['name' => 'Правый', 'created_by' => 1, 'updated_by' => 1]);

        $this->createTable('transmissions', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);
        $this->insert('transmissions', ['name' => 'Автомат', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('transmissions', ['name' => 'Вариатор', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('transmissions', ['name' => 'Механика', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('transmissions', ['name' => 'Типтроник', 'created_by' => 1, 'updated_by' => 1]);

        $this->createTable('privods', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);
        $this->insert('privods', ['name' => 'Задний', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('privods', ['name' => 'Передний', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('privods', ['name' => '4х4', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('privods', ['name' => 'AWD', 'created_by' => 1, 'updated_by' => 1]);

        $this->createTable('kuzovs', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);
        $this->insert('kuzovs', ['name' => 'Внедорожник', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('kuzovs', ['name' => 'Купе', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('kuzovs', ['name' => 'Минивен', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('kuzovs', ['name' => 'Пикап', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('kuzovs', ['name' => 'Седан', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('kuzovs', ['name' => 'Универсал', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('kuzovs', ['name' => 'Хетчбек', 'created_by' => 1, 'updated_by' => 1]);

        $this->createTable('engines', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);
        $this->insert('engines', ['name' => 'Бензин', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('engines', ['name' => 'Дизель', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('engines', ['name' => 'Бензин/Газ', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('engines', ['name' => 'Прочее', 'created_by' => 1, 'updated_by' => 1]);

        $this->createTable('colors', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);
        $this->insert('colors', ['name' => 'Бежевый', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('colors', ['name' => 'Белый', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('colors', ['name' => 'Оранжевый', 'created_by' => 1, 'updated_by' => 1]);

        $this->createTable('states', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);
        $this->insert('states', ['name' => 'Свежее', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('states', ['name' => 'Отличное', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('states', ['name' => 'Хорошее', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('states', ['name' => 'Среднее', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('states', ['name' => 'Битый', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('states', ['name' => 'Новый', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('states', ['name' => 'Требует ремонта', 'created_by' => 1, 'updated_by' => 1]);

        $this->createTable('regions', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);
        $this->insert('regions', ['name' => 'Бишкек/Чуй обл.', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('regions', ['name' => 'Ош обл.', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('regions', ['name' => 'Жалал-абад обл.', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('regions', ['name' => 'Баткен обл.', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('regions', ['name' => 'Ысык-Кол обл.', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('regions', ['name' => 'Нарын обл.', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('regions', ['name' => 'Талас обл.', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('regions', ['name' => 'На заказ', 'created_by' => 1, 'updated_by' => 1]);

        $this->createTable('moto_types', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);
        $this->insert('moto_types', ['name' => '1 тип', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('moto_types', ['name' => '2 тип', 'created_by' => 1, 'updated_by' => 1]);

        $this->createTable('sq_categories', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);
        $this->insert('sq_categories', ['name' => '1 категория', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('sq_categories', ['name' => '2 категория', 'created_by' => 1, 'updated_by' => 1]);

        $this->createTable('complete_sets', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            ], $tableOptions);
        $this->insert('complete_sets', ['name' => 'ABS', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'ASR  (Антипробуксовочная система)', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'EBD', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'ESP', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'SRS', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Авт.печь (webasto)', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'ГУР', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Бортовой компьютер', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Датчик дождя', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Датчик света', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Иммобилайзер', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Камера заднего вида', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Климат-контроль', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Кондиционер', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Корректор фар', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Круиз-контроль', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Ксенон', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Легкосплавные диски', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Люк', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Мультируль', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Навигационная система', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Омыватель фар', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Парктроник', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Сигнализация', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Система курсовой стабилизации (ESP)', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Тонировка', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Фаркоп', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Центральный замок', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Электрозеркала', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Электропакет', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Электростеклоподъемники', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Подогрев сидений', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Полная комплектация', 'created_by' => 1, 'updated_by' => 1]);
        $this->insert('complete_sets', ['name' => 'Салон – велюр/ кожа/ комбинированный/ ткань', 'created_by' => 1, 'updated_by' => 1]);

        $this->createTable('cars_complete_sets', [
            'car_id' => Schema::TYPE_BIGINT . ' NOT NULL',
            'complete_set_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'PRIMARY KEY(car_id, complete_set_id)',
            ], $tableOptions);

        $this->createTable('cars', [
            'id' => Schema::TYPE_BIGPK,
            'type_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'marka_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'model_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'wheel_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'kuzov_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'privod_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'transmission_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'engine_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'engine_displacement' => Schema::TYPE_FLOAT . ' NOT NULL',
            'color_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'state_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'region_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'sq_category_id' => Schema::TYPE_INTEGER,
            'moto_type_id' => Schema::TYPE_INTEGER,
            'price' => Schema::TYPE_DECIMAL . ' NOT NULL default 0',
            'issue_date' => Schema::TYPE_INTEGER . ' NOT NULL',
            'run_length' => Schema::TYPE_INTEGER . ' NOT NULL',
            'description' => Schema::TYPE_TEXT,
            'premium_date' => Schema::TYPE_DATETIME,
            'rent' => Schema::TYPE_BOOLEAN . ' default false',
            'rent_price' => Schema::TYPE_DECIMAL,
            'created_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_by' => Schema::TYPE_INTEGER . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL'
            ], $tableOptions);
    }

    public function down() {
        $this->dropTable('cars');
        $this->dropTable('car_types');
        $this->dropTable('markas');
        $this->dropTable('kuzovs');
        $this->dropTable('privods');
        $this->dropTable('engines');
        $this->dropTable('wheels');
        $this->dropTable('states');
        $this->dropTable('colors');
        $this->dropTable('regions');
        $this->dropTable('transmissions');
        $this->dropTable('complete_sets');
        $this->dropTable('cars_complete_sets');
        $this->dropTable('moto_types');
        $this->dropTable('sq_categories');
        $this->dropTable('car_models');
    }

}
