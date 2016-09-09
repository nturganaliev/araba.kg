<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\AutomobileQuery */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
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
                        'class' => 'col-lg-6 col-md-6 col-sm-6'
                    ],
                ])
                ->dropDownList(ArrayHelper::map(\common\models\Marka::find()->all(), 'id', 'tname'), [
                    'prompt' => yii::t('app', 'Марка'),
                    'id' => 'auto-marka-id',
                ])->label(false);
            echo $form->field($model, 'transmission_id', [
                'options' => [
                    'class' => 'col-lg-3 col-md-3 col-sm-3'
                ]
            ])->dropDownList(ArrayHelper::map(\common\models\Transmission::find()->all(), 'id', 'tname'), [
                'prompt' => yii::t('app', 'КПП')
            ])->label(FALSE);

            echo $form->field($model, 'color_id', [
                'options' => [
                    'class' => 'col-lg-3 col-md-3 col-sm-3'
                ]
            ])->dropDownList(ArrayHelper::map(\common\models\Color::find()->all(), 'id', 'tname'), [
                'prompt' => yii::t('app', 'Цвет')
            ])->label(FALSE);
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $form->field($model, 'model_id', [
                'options' => [
                    'class' => 'col-lg-6 col-md-6 col-sm-6'
                ],
            ])->widget(DepDrop::classname(), [
                'options' => ['id' => 'auto-model-id'],
                'data' => ($model->isNewRecord) ? [] : ArrayHelper::map(common\models\CarModel::findAllMarkasSeries($model->marka_id), 'id', 'tname'),
                'pluginOptions' => [
                    'depends' => ['auto-marka-id'],
                    'prompt' => yii::t('app', 'Модель'),
                    'url' => yii\helpers\Url::to(['/car/series'])
                ]
            ])->label(false);
            echo $form->field($model, 'wheel_id', [
                'options' => [
                    'class' => 'col-lg-3 col-md-3 col-sm-3'
                ]
            ])->dropDownList(ArrayHelper::map(\common\models\Wheel::find()->all(), 'id', 'tname'), [
                'prompt' => yii::t('app', 'Руль')
            ])->label(FALSE);
            echo $form->field($model, 'region_id', [
                'options' => [
                    'class' => 'col-lg-3 col-md-3 col-sm-3'
                ]
            ])->dropDownList(ArrayHelper::map(\common\models\Region::find()->all(), 'id', 'tname'), [
                'prompt' => yii::t('app', 'Регион')
            ])->label(FALSE);
            ?>
        </div>
        <div class="form-group">
            <?php
            echo $form->field($model, 'issueDateFrom', [
                'options' => [
                    'class' => 'col-lg-3 col-md-3 col-sm-3'
                ]
            ])->dropDownList(common\models\Car::getYears(), [
                'prompt' => yii::t('app', 'Год от')
            ])->label(FALSE);
            echo $form->field($model, 'issueDateTo', [
                'options' => [
                    'class' => 'col-lg-3 col-md-3 col-sm-3'
                ]
            ])->dropDownList(common\models\Car::getYears(), [
                'prompt' => yii::t('app', 'Год до')
            ])->label(false);
            echo $form->field($model, 'engine_id', [
                'options' => [
                    'class' => 'col-lg-3 col-md-3 col-sm-3'
                ],
            ])->dropDownList(ArrayHelper::map(\common\models\Engine::find()->all(), 'id', 'tname'), [
                'prompt' => yii::t('app', 'Двигатель')
            ])->label(false);

            echo $form->field($model, 'hasImages', [
                'options' => [
                    'class' => 'col-lg-3 col-md-3 col-sm-3'
                ]
            ])->checkbox()->label(Yii::t('app','Фото'));
            ?>
            <div class="clearfix"></div>
        </div>
        <div class="form-group">
            <?php
            echo $form->field($model, 'priceFrom', [
                'options' => [
                    'class' => 'col-lg-3 col-md-3 col-sm-3',
                ]
            ])->input('number', [
                'placeholder' => Yii::t('app', 'Цена от'),
            ])->label(false);
            echo $form->field($model, 'priceTo', [
                'options' => [
                    'class' => 'col-lg-3 col-md-3 col-sm-3'
                ]
            ])->input('number', [
                'placeholder' => Yii::t('app', 'Цена до'),
            ])->label(false);

            echo $form->field($model, 'kuzov_id', [
                'options' => [
                    'class' => 'col-lg-3 col-md-3 col-sm-3'
                ],
            ])->dropDownList(ArrayHelper::map(\common\models\Kuzov::find()->all(), 'id', 'tname'), [
                'prompt' => yii::t('app', 'Кузов')
            ])->label(false);
            ?>

            <div class = "col-lg-3 col-md-3 col-sm-3">
                <?php echo Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary form-control']) ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php ActiveForm::end(); ?>


    </div>
</div>
