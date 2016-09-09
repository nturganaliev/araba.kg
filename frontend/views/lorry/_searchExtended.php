<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use common\models\CarModel;
use common\models\Car;

/* @var $this yii\web\View */
/* @var $model common\models\AutomobileQuery */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="automobile-search">

    <?php
    $form = ActiveForm::begin([
            'id' => 'lorry-search-form',
            'action' => ['/car', 'type' => common\models\Car::CAR_TYPE_LORRY],
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
            ->dropDownList(ArrayHelper::map(\common\models\Marka::find()->lorry()->all(), 'id', 'tname'), [
                'prompt' => yii::t('app', 'Марка'),
                'id' => 'lorry-marka-id',
            ])->label(false);

        echo $form->field($model, 'kuzov_id', [
            'options' => [
                'class' => 'col-lg-6 col-md-6 col-sm-6'
            ],
        ])->dropDownList(ArrayHelper::map(\common\models\Kuzov::getByCarType(Car::CAR_TYPE_LORRY), 'id', 'tname'), [
            'prompt' => yii::t('app', 'Кузов')
        ])->label(false);

        echo $form->field($model, 'color_id', [
            'options' => [
                'class' => 'col-lg-6 col-md-6 col-sm-6'
            ]
        ])->dropDownList(ArrayHelper::map(\common\models\Color::getByCarType(Car::CAR_TYPE_LORRY), 'id', 'tname'), [
            'prompt' => yii::t('app', 'Цвет')
        ])->label(FALSE);
        ?>
    </div>
    <div class="form-group">
        <?php
//        echo $form->field($model, 'model_id', [
//            'options' => [
//                'class' => 'col-lg-12 col-md-12 col-sm-12'
//            ],
//        ])->widget(DepDrop::classname(), [
//            'options' => [
//                'id' => 'lorry-model-id',
//                'placeholder' => yii::t('app', 'Модель'),
//            ],
//            'data' => ($model->marka_id == null) ? [] : ArrayHelper::map(CarModel::findMergedNames($model->marka_id), 'id', 'tname'),
//            'pluginOptions' => [
//                'depends' => ['lorry-marka-id'],
//                'placeholder' => yii::t('app', 'Модель'),
//                'url' => yii\helpers\Url::to(['/car/series'])
//            ]
//        ])->label(false);
        echo $form->field($model, 'model_name', [
            'options' => [
                'class' => 'col-lg-12 col-md-12 col-sm-12'
            ],
        ])->textInput(['placeholder' => Yii::t('app', 'Lorry models')])->label(false);
        echo $form->field($model, 'transmission_id', [
            'options' => [
                'class' => 'col-lg-6 col-md-6 col-sm-6'
            ]
        ])->dropDownList(ArrayHelper::map(\common\models\Transmission::getByCarType(Car::CAR_TYPE_LORRY), 'id', 'tname'), [
            'prompt' => yii::t('app', 'КПП')
        ])->label(FALSE);

        echo $form->field($model, 'region_id', [
            'options' => [
                'class' => 'col-lg-6 col-md-6 col-sm-6'
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
                'class' => 'col-lg-6 col-md-6 col-sm-6'
            ],
            'template' => '{label} <div class="tiree-wrapper">{input}{error}<div class="tiree"> - </div></div>',
        ])->dropDownList(common\models\Car::getYears(false), [
            'prompt' => yii::t('app', 'Год от')
        ])->label(FALSE);
        echo $form->field($model, 'issueDateTo', [
            'options' => [
                'class' => 'col-lg-6 col-md-6 col-sm-6'
            ]
        ])->dropDownList(common\models\Car::getYears(false), [
            'prompt' => yii::t('app', 'Год до')
        ])->label(false);
        echo $form->field($model, 'wheel_id', [
            'options' => [
                'class' => 'col-lg-6 col-md-6 col-sm-6'
            ]
        ])->dropDownList(ArrayHelper::map(\common\models\Wheel::getByCarType(Car::CAR_TYPE_LORRY), 'id', 'tname'), [
            'prompt' => yii::t('app', 'Руль')
        ])->label(FALSE);

        echo $form->field($model, 'hasImages', [
            'options' => [
                'class' => 'col-lg-6 col-md-6 col-sm-6'
            ]
        ])->checkbox()->label(Yii::t('app','Фото'));
        ?>
        <!--<div class="clearfix"></div>-->
    </div>
    <div class="form-group">
        <?php
        echo $form->field($model, 'priceFrom', [
            'options' => [
                'class' => 'col-xs-6',
            ],
            'template' => '{label} <div class="tiree-wrapper">{input}{error}<div class="tiree"> - </div></div>',
        ])->dropDownList(common\models\Car::getPriceList(), [
            'prompt' => Yii::t('app', 'Price from')
        ])->label(false);
        echo $form->field($model, 'priceTo', [
            'options' => [
                'class' => 'col-xs-6'
            ]
        ])->dropDownList(common\models\Car::getPriceList(), [
            'prompt' => Yii::t('app', 'Price to')
        ])->label(false);

        echo $form->field($model, 'engine_id', [
            'options' => [
                'class' => 'col-lg-6 col-md-6 col-sm-6'
            ],
        ])->dropDownList(ArrayHelper::map(\common\models\Engine::getByCarType(Car::CAR_TYPE_LORRY), 'id', 'tname'), [
            'prompt' => yii::t('app', 'Двигатель')
        ])->label(false);
        ?>
        <div class = "col-sm-offset-2 col-sm-4">
            <?php
            echo Html::submitButton(Yii::t('app', 'Search <span style="color:orange;" class="fa fa-angle-double-right fa-lg">'), ['class' => 'btn btn-default form-control'])
            ?>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>


</div>
