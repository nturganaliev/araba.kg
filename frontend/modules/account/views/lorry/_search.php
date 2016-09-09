<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $model common\models\CarQuery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-search">

    <?php
    $form = ActiveForm::begin([
            'id' => 'lorry-search-form',
            'action' => ['/car', 'type' => common\models\Car::CAR_TYPE_LORRY],
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
                    'class' => 'col-lg-6 col-md-6 col-sm-6'
                ],
            ])
            ->dropDownList(ArrayHelper::map(\common\models\Marka::find()->all(), 'id', 'tname'), [
                'prompt' => yii::t('app', 'All markas'),
                'id' => 'lorry-marka-id',
        ]);
        echo $form->field($model, 'issueDateFrom', [
            'options' => [
                'class' => 'col-lg-3 col-md-3 col-sm-3'
            ]
        ])->dropDownList(common\models\Car::getYears(), [
            'prompt' => yii::t('app', 'Any')
        ]);
        echo $form->field($model, 'issueDateTo', [
            'options' => [
                'class' => 'col-lg-3 col-md-3 col-sm-3'
            ]
        ])->dropDownList(common\models\Car::getYears(), [
            'prompt' => yii::t('app', 'Any')
        ])->label('&nbsp');
        ?>
    </div>
    <div class="form-group">
        <?php
        echo $form->field($model, 'model_id', [
            'options' => [
                'class' => 'col-lg-6 col-md-6 col-sm-6'
            ],
        ])->widget(DepDrop::classname(), [
            'options' => ['id' => 'lorry-model-id'],
            'data' => ($model->isNewRecord) ? [] : ArrayHelper::map(common\models\CarModel::findAllMarkasSeries($model->marka_id), 'id', 'tname'),
            'pluginOptions' => [
                'depends' => ['lorry-marka-id'],
                'prompt' => yii::t('app', 'All models'),
                'url' => yii\helpers\Url::to(['/car/series'])
            ]
        ]);
        echo $form->field($model, 'priceFrom', [
            'options' => [
                'class' => 'col-lg-3 col-md-3 col-sm-3'
            ]
        ])->input('number');
        echo $form->field($model, 'priceTo', [
            'options' => [
                'class' => 'col-lg-3 col-md-3 col-sm-3'
            ]
        ])->input('number')->label('&nbsp');
        ?>
    </div>
    <div class="form-group">
        <?php
        echo $form->field($model, 'kuzov_id', [
            'options' => [
                'class' => 'col-lg-6 col-md-6 col-sm-6'
            ],
        ])->dropDownList(ArrayHelper::map(\common\models\Kuzov::find()->all(), 'id', 'tname'), [
            'prompt' => yii::t('app', 'All kuzovs')
        ]);
        ?>
        <div class = "col-lg-offset-3 col-lg-3 col-md-3 col-sm-3">
            <label class="control-label">&nbsp;</label>
            <?php echo Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary form-control']) ?>
        </div>


    </div>
    <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>

</div>
