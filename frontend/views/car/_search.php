<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\tabs\TabsX;

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
//        'label' => '<i class="flaticon-sedan4"></i>',
        'label' => '<img src="/images/icons/auto-t.png" id="first_search_icon" class="img-responsive search_icon"></span>',
//        'label' => '1',
        'content' => $this->render('/automobile/_search', [
            'model' => $modelAutomobile,
        ]),
        'active' => true
    ],
    [
        'label' => '<img src="/images/icons/bus-t.png" id="second_search_icon" class="img-responsive search_icon"></span>',
//        'label' => '2',
        'content' => $this->render('/bus/_search', [
            'model' => $modelBus,
        ]),
//        'linkOptions' => ['data-url' => \yii\helpers\Url::to(['/site/tabs-data'])]
    ],
    [
        'label' => '<img src="/images/icons/truck-t.png" id="third_search_icon" class="img-responsive search_icon"></span>',
//        'label' => '5',
        'content' => $this->render('/lorry/_search', [
            'model' => $modelLorry,
        ]),
    ],
    [
        'label' => '<img src="/images/icons/moto-t.png" id="fourth_search_icon" class="img-responsive search_icon"></span>',
//        'label' => '4',
        'content' => $this->render('/motocycle/_search', [
            'model' => $modelMoto,
        ]),
    ],
    [
        'label' => '<img src="/images/icons/sq-t.png" id="fifth_search_icon" class="img-responsive search_icon"></span>',
//        'label' => '3',
        'content' => $this->render('/special-equipment/_search', [
            'model' => $modelSQ,
            'rent' => false
        ]),
    ],
    [
        'label' => '<img src="/images/icons/rent-t.png" id="sixth_search_icon" class="img-responsive search_icon"></span>',
        'content' => $this->render('/special-equipment/_search', [
            'model' => $modelSQ,
            'rent' => true
        ]),
    ],
];
?>
<div class="row">
    <div class="col-sm-24">
        <?php
        echo TabsX::widget([
            'items' => $items,
            'position' => TabsX::POS_LEFT,
//            'height' => 'tab-height-custom',
            'encodeLabels' => false,
            'bordered' => true,
            'containerOptions' => [
//                'class' => 'tab-height-custom',
            ]
        ]);
        ?>
    </div>
</div>


