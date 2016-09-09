<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $model common\models\Automobile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="automobile-form">
    <?php
    $form = ActiveForm::begin([
            'layout' => 'horizontal',
            'options' => [
                'enctype' => 'multipart/form-data'
            ],
            'fieldConfig' => [
//                'template' => '{label}<div class="col-sm-8">{input}</div><div class="col-sm-8">{error}</div>',
//                'labelOptions' => ['class' => 'col-sm-2 control-label'],
                'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                'horizontalCssClasses' => [
                    'label' => 'col-sm-4',
                    'offset' => 'col-sm-offset-8',
                    'wrapper' => 'col-sm-8',
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
                    'class' => 'col-lg-8 col-md-8 col-sm-8'
                ],
//            'inputTemplate' => '<div class="input-group"><span class="input-group-addon">@</span>{input}</div>',
//            'template' => '<div class="col-sm-8 col-md-8 col-lg-8">{label}{input}{error}{hint}</div>'
            ])
            ->dropDownList(ArrayHelper::map(\common\models\Marka::find()->all(), 'id', 'name'), [
                'prompt' => yii::t('app', 'Select ...'),
                'id' => 'marka-id',
        ]);
        ?>
        <?=
        $form->field($model, 'model_id', [
            'options' => [
                'class' => 'col-lg-8 col-md-8 col-sm-8',
            ],
        ])->widget(DepDrop::classname(), [
            'options' => [
                'id' => 'model-id',
                'placeholder' => \Yii::t('app', 'Select...'),
            ],
            'data' => ($model->marka_id == NULL) ? [] : ArrayHelper::map(common\models\CarModel::findAllMarkasSeries($model->marka_id), 'id', 'name'),
            'pluginOptions' => [
                'depends' => ['marka-id'],
                'placeholder' => yii::t('app', 'Select...'),
                'url' => yii\helpers\Url::to(['/car/series'])
            ]
        ]);
        ?>
        <?=
        $form->field($model, 'wheel_id', [
            'options' => [
                'class' => 'col-lg-8 col-md-8 col-sm-8'
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
                'class' => 'col-lg-8 col-md-8 col-sm-8'
            ],
        ])->dropDownList(ArrayHelper::map(\common\models\Kuzov::find()->all(), 'id', 'name'), [
            'prompt' => yii::t('app', 'Select ...')
        ]);
        ?>

        <?=
        $form->field($model, 'privod_id', [
            'options' => [
                'class' => 'col-lg-8 col-md-8 col-sm-8'
            ],
        ])->dropDownList(ArrayHelper::map(\common\models\Privod::find()->all(), 'id', 'name'), [
            'prompt' => yii::t('app', 'Select ...')
        ]);
        ?>

        <?=
        $form->field($model, 'transmission_id', [
            'options' => [
                'class' => 'col-lg-8 col-md-8 col-sm-8'
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
                'class' => 'col-lg-8 col-md-8 col-sm-8'
            ],
        ])->dropDownList(ArrayHelper::map(\common\models\Engine::find()->all(), 'id', 'name'), [
            'prompt' => yii::t('app', 'Select ...')
        ]);
        ?>

        <?=
        $form->field($model, 'engine_displacement', [
            'options' => [
                'class' => 'col-lg-8 col-md-8 col-sm-8'
            ],
        ])->textInput()
        ?>

        <?=
        $form->field($model, 'color_id', [
            'options' => [
                'class' => 'col-lg-8 col-md-8 col-sm-8'
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
                'class' => 'col-lg-8 col-md-8 col-sm-8'
            ],
        ])->dropDownList(ArrayHelper::map(\common\models\State::find()->all(), 'id', 'name'), [
            'prompt' => yii::t('app', 'Select ...')
        ]);
        ?>

        <?=
        $form->field($model, 'region_id', [
            'options' => [
                'class' => 'col-lg-8 col-md-8 col-sm-8'
            ],
        ])->dropDownList(ArrayHelper::map(\common\models\Region::find()->all(), 'id', 'name'), [
            'prompt' => yii::t('app', 'Select ...')
        ]);
        ?>

        <?=
        $form->field($model, 'price', [
            'options' => [
                'class' => 'col-lg-8 col-md-8 col-sm-8'
            ],
        ])->textInput()
        ?>
    </div>
    <div class="form-group">
        <?=
        $form->field($model, 'issue_date', [
            'options' => [
                'class' => 'col-lg-8 col-md-8 col-sm-8'
            ],
        ])->dropDownList(\common\models\Car::getYears());
        ?>

        <?=
        $form->field($model, 'run_length', [
            'options' => [
                'class' => 'col-lg-8 col-md-8 col-sm-8'
            ],
        ])->textInput()
        ?>

        <?=
        $form->field($model, 'description', [
            'options' => [
                'class' => 'col-lg-8 col-md-8 col-sm-8'
            ],
        ])->textarea(['rows' => 6])
        ?>
    </div>
    <div class="form-group">
        <?php
        echo $form->field($model, 'completeSets', [
            'options' => [
                'class' => 'col-lg-24 col-md-24 col-sm-24'
            ]
        ])->checkboxList(ArrayHelper::map(\common\models\CompleteSet::find()->all(), 'id', 'name'), [
            'item' => function ($index, $label, $name, $checked, $value) {
                return Html::checkbox($name, $checked, [
                        'value' => $value,
                        'label' => '<label for="' . $label . '">' . $label . '</label>',
                        'labelOptions' => [
                            'class' => 'ckbox ckbox-primary col-lg-8 col-md-8 col-sm-8',
                        ],
                        'id' => $label,
//                            'class' => '',
                ]);
            }
            ])->label(false);
            ?>

        </div>
        <div class="form-group">

            <?php
            echo $form->field($model, 'images[]')->widget(FileInput::classname(), [
                'options' => [
//                    'accept' => 'image/*',
                    'multiple' => true,
                ],
                'pluginOptions' => [
                    'showUpload' => false,
                    'uploadUrl' => \yii\helpers\Url::to(['/site/file-upload']),
                    'fileUpload' => false,
                    'initialPreviewShowDelete' => true,
                    'allowedFileTypes' => [
                        'image'
                    ],
                    'allowedFileExtensions' => [
                        'jpg',
                        'jpeg'
                    ]
                ]
            ]);
            ?>
        </div>
        <div class="form-group">
            <div class="col-lg-24 col-md-24 col-sm-24">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php ActiveForm::end(); ?>

</div>

