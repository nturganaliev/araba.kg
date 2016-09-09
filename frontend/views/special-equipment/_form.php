<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $model common\models\SpecialEquipment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sq-form">

    <?php
    $form = ActiveForm::begin([
            'id' => 'create-sq-form',
//          'layout' => '',
            'fieldConfig' => [
//                'template' => '{label}<div class="col-sm-4">{input}</div><div class="col-sm-4">{error}</div>',
//                'labelOptions' => ['class' => 'col-sm-2 control-label'],
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-2',
                    'offset' => 'col-sm-offset-4',
                    'wrapper' => 'col-sm-4',
                    'error' => '',
                    'hint' => '',
                ],
            ],
    ]);
    ?>
    <div class="form-group">

        <?=
        Html::activeHiddenInput($model, 'type_id');
        ?>

        <?=
            $form->field($model, 'marka_id', [
                'options' => [
                    'class' => 'col-lg-4 col-md-4 col-sm-4'
                ],
//            'inputTemplate' => '<div class="input-group"><span class="input-group-addon">@</span>{input}</div>',
//            'template' => '<div class="col-sm-4 col-md-4 col-lg-4">{label}{input}{error}{hint}</div>'
            ])
            ->dropDownList(ArrayHelper::map(\common\models\Marka::find()->all(), 'id', 'name'), [
                'prompt' => yii::t('app', 'Select ...'),
                'id' => 'sq-marka-id',
        ]);
        ?>
        <?=
        $form->field($model, 'model_id', [
            'options' => [
                'class' => 'col-lg-4 col-md-4 col-sm-4'
            ],
        ])->widget(DepDrop::classname(), [
            'options' => ['id' => 'sq-model-id'],
            'data' => ($model->isNewRecord) ? [] : ArrayHelper::map(common\models\CarModel::findAllMarkasSeries($model->marka_id), 'id', 'name'),
            'pluginOptions' => [
                'depends' => ['sq-marka-id'],
                'placeholder' => yii::t('app', 'Select...'),
                'url' => yii\helpers\Url::to(['/car/series'])
            ]
        ]);
        ?>
        <?=
        $form->field($model, 'wheel_id', [
            'options' => [
                'class' => 'col-lg-4 col-md-4 col-sm-4'
            ],
        ])->dropDownList(ArrayHelper::map(\common\models\Wheel::find()->all(), 'id', 'name'), [
            'prompt' => yii::t('app', 'Select ...')
        ]);
        ?>
    </div>
    <div class="form-group">
        <?=
        $form->field($model, 'kuzov_id', [
            'options' => [
                'class' => 'col-lg-4 col-md-4 col-sm-4'
            ],
        ])->dropDownList(ArrayHelper::map(\common\models\Kuzov::find()->all(), 'id', 'name'), [
            'prompt' => yii::t('app', 'Select ...')
        ]);
        ?>

        <?=
        $form->field($model, 'privod_id', [
            'options' => [
                'class' => 'col-lg-4 col-md-4 col-sm-4'
            ],
        ])->dropDownList(ArrayHelper::map(\common\models\Privod::find()->all(), 'id', 'name'), [
            'prompt' => yii::t('app', 'Select ...')
        ]);
        ?>

        <?=
        $form->field($model, 'transmission_id', [
            'options' => [
                'class' => 'col-lg-4 col-md-4 col-sm-4'
            ],
        ])->dropDownList(ArrayHelper::map(\common\models\Transmission::find()->all(), 'id', 'name'), [
            'prompt' => yii::t('app', 'Select ...')
        ]);
        ?>
    </div>
    <div class="form-group">
        <?=
        $form->field($model, 'engine_id', [
            'options' => [
                'class' => 'col-lg-4 col-md-4 col-sm-4'
            ],
        ])->dropDownList(ArrayHelper::map(\common\models\Engine::find()->all(), 'id', 'name'), [
            'prompt' => yii::t('app', 'Select ...')
        ]);
        ?>

        <?=
        $form->field($model, 'engine_displacement', [
            'options' => [
                'class' => 'col-lg-4 col-md-4 col-sm-4'
            ],
        ])->textInput()
        ?>

        <?=
        $form->field($model, 'color_id', [
            'options' => [
                'class' => 'col-lg-4 col-md-4 col-sm-4'
            ],
        ])->dropDownList(ArrayHelper::map(\common\models\Color::find()->all(), 'id', 'name'), [
            'prompt' => yii::t('app', 'Select ...')
        ]);
        ?>
    </div>
    <div class="form-group">
        <?=
        $form->field($model, 'state_id', [
            'options' => [
                'class' => 'col-lg-4 col-md-4 col-sm-4'
            ],
        ])->dropDownList(ArrayHelper::map(\common\models\State::find()->all(), 'id', 'name'), [
            'prompt' => yii::t('app', 'Select ...')
        ]);
        ?>

        <?=
        $form->field($model, 'region_id', [
            'options' => [
                'class' => 'col-lg-4 col-md-4 col-sm-4'
            ],
        ])->dropDownList(ArrayHelper::map(\common\models\Region::find()->all(), 'id', 'name'), [
            'prompt' => yii::t('app', 'Select ...')
        ]);
        ?>

        <?=
        $form->field($model, 'price', [
            'options' => [
                'class' => 'col-lg-4 col-md-4 col-sm-4'
            ],
        ])->textInput()
        ?>
    </div>
    <div class="form-group">
        <?=
        $form->field($model, 'issue_date', [
            'options' => [
                'class' => 'col-lg-4 col-md-4 col-sm-4'
            ],
        ])->input('date')
        ?>

        <?=
        $form->field($model, 'run_length', [
            'options' => [
                'class' => 'col-lg-4 col-md-4 col-sm-4'
            ],
        ])->textInput()
        ?>

        <?=
        $form->field($model, 'description', [
            'options' => [
                'class' => 'col-lg-4 col-md-4 col-sm-4'
            ],
        ])->textarea(['rows' => 6])
        ?>
    </div>
    <div class="form-group">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>

</div>

