<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\widgets\DepDrop;
use common\models\Car;

/* @var $this yii\web\View */
/* @var $model common\models\CarQuery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-search">

    <?php
    $form = ActiveForm::begin([
            'id' => 'moto-search-form',
            'action' => ['/car', 'type' => common\models\Car::CAR_TYPE_MOTOCYCLE],
            'method' => 'get',
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
            ->dropDownList(ArrayHelper::map(\common\models\Marka::find()->motocycle()->all(), 'id', 'tname'), [
                'prompt' => yii::t('app', 'All markas'),
                'id' => 'moto-marka-id',
        ]);
        echo $form->field($model, 'issueDateFrom', [
            'options' => [
                'class' => 'col-lg-6 col-md-6 col-sm-6'
            ],
            'template' => '{label} <div class="tiree-wrapper">{input}{error}<div class="tiree"> - </div></div>',
        ])->dropDownList(common\models\Car::getYears(false), [
            'prompt' => yii::t('app', 'Year from')
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
//        echo $form->field($model, 'model_id', [
//            'options' => [
//                'class' => 'col-lg-12 col-md-12 col-sm-12'
//            ],
//        ])->widget(DepDrop::classname(), [
//            'options' => ['id' => 'moto-model-id', 'placeholder' => yii::t('app', 'All models'),],
//            'data' => ($model->isNewRecord) ? [] : ArrayHelper::map(common\models\CarModel::findAllMarkasSeries($model->marka_id), 'id', 'tname'),
//            'pluginOptions' => [
//                'depends' => ['moto-marka-id'],
//                'placeholder' => yii::t('app', 'All models'),
//                'url' => yii\helpers\Url::to(['/car/series'])
//            ]
//        ]);
        echo $form->field($model, 'model_name', [
            'options' => [
                'class' => 'col-lg-12 col-md-12 col-sm-12'
            ],
        ])->textInput(['placeholder' => Yii::t('app', 'All motocycle models')]);
        echo $form->field($model, 'priceFrom', [
            'options' => [
                'class' => 'col-lg-6 col-md-6 col-sm-6'
            ],
            'template' => '{label} <div class="tiree-wrapper">{input}{error}<div class="tiree"> - </div></div>',
        ])->dropDownList(common\models\Car::getPriceList(), [
            'prompt' => Yii::t('app', 'Year from')
        ]);
//        echo '-';
        echo $form->field($model, 'priceTo', [
            'options' => [
                'class' => 'col-lg-6 col-md-6 col-sm-6'
            ]
        ])->dropDownList(common\models\Car::getPriceList(), [
            'prompt' => Yii::t('app', 'Year to')
        ])->label('&nbsp');
        ?>
    </div>
    <div class="form-group">
        <?php
        echo $form->field($model, 'moto_type_id', [
            'options' => [
                'class' => 'col-lg-12 col-md-12 col-sm-12'
            ],
        ])->dropDownList(ArrayHelper::map(\common\models\MotoType::find()->all(), 'id', 'tname'), [
            'prompt' => yii::t('app', 'All moto types')
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
            Html::a(Yii::t('app', 'Detailed search'), ['/car', 'type' => common\models\Car::CAR_TYPE_MOTOCYCLE], [
                'class' => 'detailed_search'
            ])
            ?>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>

</div>
