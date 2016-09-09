<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use common\models\Car;
use common\models\Wheel;

/* @var $this yii\web\View */
/* @var $model common\models\AutomobileQuery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="automobile-search">

    <?php
    $form = ActiveForm::begin([
            'id' => 'automobile-search-form',
            'action' => ['/car', 'type' => common\models\Car::CAR_TYPE_AUTOMOBILE],
            'method' => 'GET',
            'fieldConfig' => [
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            ],
    ]);
    ?>
    <div class="form-group">
        <?=
        Html::activeHiddenInput($model, 'type_id');
        ?>
        <?php
        echo $form->field($model, 'marka_id', [
                'options' => [
                    'class' => 'col-lg-12 col-md-12 col-sm-12'
                ],
            ])
            ->dropDownList(ArrayHelper::map(\common\models\Marka::find()->automobile()
                    ->select(['id', "concat(' ', name) as name"])
                    ->all(), 'id', 'tname'), [
                'prompt' => yii::t('app', 'All markas'),
                'id' => 'auto-marka-id',
//                'encodeSpaces' => true,
        ]);
        echo $form->field($model, 'issueDateFrom', [
            'options' => [
                'class' => 'col-lg-6 col-md-6 col-sm-6'
            ],
            'template' => '{label} <div class="tiree-wrapper">{input}{error}<div class="tiree"> - </div></div>',
        ])->dropDownList(common\models\Car::getYears(false), [
            'prompt' => yii::t('app', 'Year from'),
        ]);
        echo $form->field($model, 'issueDateTo', [
            'options' => [
                'class' => 'col-lg-6 col-md-6 col-sm-6'
            ]
        ])->dropDownList(common\models\Car::getYears(false), [
            'prompt' => yii::t('app', 'Year to')
        ])->label('&nbsp');
        ?>
    </div>
    <div class="form-group">
        <?php
        echo $form->field($model, 'model_id', [
            'options' => [
                'class' => 'col-lg-12 col-md-12 col-sm-12',
            ],
        ])->widget(DepDrop::classname(), [
            'options' => [
                'id' => 'auto-model-id',
                'placeholder' => yii::t('app', 'All models'),
                'decode' => true,
                'encodeSpaces' => true,
            ],
            'data' => ($model->isNewRecord) ? [] : ArrayHelper::map(common\models\CarModel::findAllMarkasSeries($model->marka_id), 'id', 'tname'),
            'pluginOptions' => [
                'depends' => ['auto-marka-id'],
                'placeholder' => yii::t('app', 'All models'),
                'url' => yii\helpers\Url::to(['/car/series']),

            ]
        ]);
        echo $form->field($model, 'priceFrom', [
            'options' => [
                'class' => 'col-lg-6 col-md-6 col-sm-6'
            ],
            'template' => '{label} <div class="tiree-wrapper">{input}{error}<div class="tiree"> - </div></div>',
        ])->dropDownList(common\models\Car::getPriceList(), [
            'prompt' => Yii::t('app', 'Price from'),
            'class' => 'form-control tire-after'
        ]);
        echo $form->field($model, 'priceTo', [
            'options' => [
                'class' => 'col-lg-6 col-md-6 col-sm-6'
            ]
        ])->dropDownList(common\models\Car::getPriceList(), [
            'prompt' => Yii::t('app', 'Price to')
        ])->label('&nbsp');
        ?>
    </div>
    <div class="form-group">
        <?php
        echo $form->field($model, 'wheel_id', [
            'options' => [
                'class' => 'col-lg-12 col-md-12 col-sm-12'
            ],
        ])->dropDownList(ArrayHelper::map(Wheel::getByCarType(Car::CAR_TYPE_AUTOMOBILE), 'id', 'tname'), [
            'prompt' => yii::t('app', 'All wheels')
        ]);
        ?>
        <div class = "col-lg-offset-6 col-lg-6 col-md-6 col-sm-6">
            <label class="control-label">&nbsp;</label>
            <?php
            echo Html::submitButton(Yii::t('app', 'Search') . ' <span style="color:orange;" class="fa fa-angle-double-right fa-lg">', ['class' => 'btn btn-default form-control'])
            ?>
        </div>
        <div class="col-xs-24">
            <?=
            Html::a(Yii::t('app', 'Detailed search'), ['/car', 'type' => 1], [
                'class' => 'detailed_search'
            ])
            ?>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>
</div>
<script>/*
    $.each('#auto-marka-id option', function(i){
        i.replace('BMW','qqq');
    });*/
</script>