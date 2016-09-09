<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\tabs\TabsX;
use common\models\Car;

/* @var $this yii\web\View */
/* @var $model common\models\AutomobileQuery */
/* @var $model common\models\BusQuery */
/* @var $model common\models\LorryQuery */
/* @var $model common\models\MotocycleQuery */
/* @var $model common\models\SpecialEquipmentQuery */
/* @var $form yii\widgets\ActiveForm */
?>


<?php
$items = [
    [
        'label' => '<img src="/images/icons/auto-t.png" id="auto-t_search_icon" class="search_icon" />',
        'content' => $this->render('/automobile/_searchExtended', [
            'model' => $modelAutomobile,
        ]),
        'active' => ($type == Car::CAR_TYPE_AUTOMOBILE) ? true : false
    ],
    [
        'label' => '<img src="/images/icons/bus-t.png" id="bus-t_search_icon" class="search_icon"></span>',
        'content' => $this->render('/bus/_searchExtended', [
            'model' => $modelBus,
        ]),
        'active' => ($type == Car::CAR_TYPE_BUS) ? true : false
    ],
    [
        'label' => '<img src="/images/icons/truck-t.png" id="truck-t_search_icon" class="search_icon"></span>',
        'content' => $this->render('/lorry/_searchExtended', [
            'model' => $modelLorry,
        ]),
        'active' => ($type == Car::CAR_TYPE_LORRY) ? true : false
    ],
    [
        'label' => '<img src="/images/icons/moto-t.png" id="moto-t_search_icon" class="search_icon"></span>',
        'content' => $this->render('/motocycle/_searchExtended', [
            'model' => $modelMoto,
        ]),
        'active' => ($type == Car::CAR_TYPE_MOTOCYCLE) ? true : false
    ],
    [
        'label' => '<img src="/images/icons/sq-t.png" id="sq-t_search_icon" class="search_icon"></span>',
        'content' => $this->render('/special-equipment/_searchExtended', [
            'model' => $modelSQ,
            'rent' => false
        ]),
        'active' => ($type == Car::CAR_TYPE_SPECIAL_EQUIPMENT && $rent != Car::CAR_TYPE_RENT) ? true : false
    ],
    [
        'label' => '<img src="/images/icons/rent-t.png" id="rent-t_search_icon" class="search_icon"></span>',
        'content' => $this->render('/special-equipment/_searchExtended', [
            'model' => $modelSQ,
            'rent' => true
        ]),
        'active' => ($rent == Car::CAR_TYPE_RENT) ? true : false
    ],
];
?>
<div class="row">
    <div class="col-lg-24 col-md-24 col-sm-24">
        <?=
        TabsX::widget([
            'items' => $items,
            'position' => TabsX::POS_ABOVE,
            'encodeLabels' => false,
            'bordered' => true,
        ]);
        ?>
    </div>
</div>

