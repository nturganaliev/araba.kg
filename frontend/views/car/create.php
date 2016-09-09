<?php

use yii\helpers\Html;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $modelAutomobile common\models\Automobile */
/* @var $modelBus common\models\Bus */
/* @var $modelLorry common\models\Lorry */
/* @var $modelMoto common\models\Motocycle */
/* @var $modelSQ common\models\SpecialEquipment */

$this->title = Yii::t('app', 'Добавить {modelClass}', [
        'modelClass' => 'объявление',
    ]);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Automobiles'), 'url' => ['/account/automobile']];
//$this->params['breadcrumbs'][] = $this->title;

$items = [
    [
        'label' => '<i class="flaticon-sedan4"></i>',
        'content' => $this->render('/automobile/_form', [
            'model' => $modelAutomobile,
        ]),
        'active' => true
    ],
    [
        'label' => '<i class="flaticon-truck5"></i>',
        'content' => $this->render('/bus/_form', [
            'model' => $modelBus,
        ]),
//        'linkOptions' => ['data-url' => \yii\helpers\Url::to(['/site/tabs-data'])]
    ],
    [
        'label' => '<i class="flaticon-omnibus"></i>',
        'content' => $this->render('/lorry/_form', [
            'model' => $modelLorry,
        ]),
    ],
    [
        'label' => '<i class="flaticon-construction12"></i>',
        'content' => $this->render('/motocycle/_form', [
            'model' => $modelMoto,
        ]),
    ],
    [
        'label' => '<i class="flaticon-vehicle11"></i>',
        'content' => $this->render('/special-equipment/_form', [
            'model' => $modelSQ,
        ]),
    ],
];
?>
<div class="row">
    <div class="col-lg-4">
        <?php echo $this->render('/account/_sidebar'); ?>
    </div>
    <div class="col-lg-20">
        <div class="automobile-create">

            <h1><?= Html::encode($this->title) ?></h1>

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
</div>
