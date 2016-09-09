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
//          'layout' => '',
            'id' => 'create-lorry-form',
            'options' => [
                'enctype' => 'multipart/form-data'
            ],
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
            ->dropDownList(ArrayHelper::map(\common\models\Marka::find()->all(), 'id', 'tname'), [
                'prompt' => yii::t('app', 'Select ...'),
                'id' => 'lorry-marka-id',
        ]);
        ?>
        <?=
        $form->field($model, 'model_id', [
            'options' => [
                'class' => 'col-lg-4 col-md-4 col-sm-4'
            ],
        ])->widget(DepDrop::classname(), [
            'options' => [
                'id' => 'lorry-model-id',
                'placeholder' => yii::t('app', 'Select...'),
            ],
            'data' => ($model->marka_id == null) ? [] : ArrayHelper::map(common\models\CarModel::findAllMarkasSeries($model->marka_id), 'id', 'tname'),
            'pluginOptions' => [
                'depends' => ['lorry-marka-id'],
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
        ])->dropDownList(ArrayHelper::map(\common\models\Wheel::find()->all(), 'id', 'tname'), [
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
        ])->dropDownList(ArrayHelper::map(\common\models\Kuzov::find()->all(), 'id', 'tname'), [
            'prompt' => yii::t('app', 'Select ...')
        ]);
        ?>

        <?=
        $form->field($model, 'privod_id', [
            'options' => [
                'class' => 'col-lg-4 col-md-4 col-sm-4'
            ],
        ])->dropDownList(ArrayHelper::map(\common\models\Privod::find()->all(), 'id', 'tname'), [
            'prompt' => yii::t('app', 'Select ...')
        ]);
        ?>

        <?=
        $form->field($model, 'transmission_id', [
            'options' => [
                'class' => 'col-lg-4 col-md-4 col-sm-4'
            ],
        ])->dropDownList(ArrayHelper::map(\common\models\Transmission::find()->all(), 'id', 'tname'), [
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
        ])->dropDownList(ArrayHelper::map(\common\models\Engine::find()->all(), 'id', 'tname'), [
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
        ])->dropDownList(ArrayHelper::map(\common\models\Color::find()->all(), 'id', 'tname'), [
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
        ])->dropDownList(ArrayHelper::map(\common\models\State::find()->all(), 'id', 'tname'), [
            'prompt' => yii::t('app', 'Select ...')
        ]);
        ?>

        <?=
        $form->field($model, 'region_id', [
            'options' => [
                'class' => 'col-lg-4 col-md-4 col-sm-4'
            ],
        ])->dropDownList(ArrayHelper::map(\common\models\Region::find()->all(), 'id', 'tname'), [
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
        ])->dropDownList(\common\models\Car::getYears(), [
            'prompt' => Yii::t('app', 'Select ...')
        ]);
        ?>

        <?=
        $form->field($model, 'run_length', [
            'options' => [
                'class' => 'col-lg-4 col-md-4 col-sm-4'
            ],
        ])->textInput()
        ?>

    </div>
    <div class="form-group">
        <?php
        echo $form->field($model, 'completeSets', [
            'options' => [
                'class' => 'col-lg-12 col-md-12 col-sm-12'
            ]
        ])->checkboxList(ArrayHelper::map(\common\models\CompleteSet::find()->all(), 'id', 'tname'), [
            'item' => function ($index, $label, $name, $checked, $value) {
                return Html::checkbox($name, $checked, [
                        'value' => $value,
                        'label' => '<label for="' . $label . '">' . $label . '</label>',
                        'labelOptions' => [
                            'class' => 'ckbox ckbox-primary col-lg-4 col-md-4 col-sm-4',
                        ],
                        'id' => $label,
//                            'class' => '',
                ]);
            }
            ])->label(true);
            ?>

        </div>
        <div class="form-group">
            <?=
            $form->field($model, 'description', [
                'options' => [
                    'class' => 'col-sm-12'
                ],
            ])->textarea(['rows' => 6])
            ?>
        </div>
        <div class="form-group">

            <?php
            echo $form->field($model, 'images[]', [
                'options' => [
                    'class' => 'col-sm-12'
                ],
            ])->widget(FileInput::classname(), [
                'options' => [
//                    'accept' => 'image/*',
                    'multiple' => true,
                ],
                'pluginOptions' => [
                    'showUpload' => false,
                    'uploadUrl' => \yii\helpers\Url::to(['/site/upload']),
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
            <div class="col-lg-12 col-md-12 col-sm-12">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php ActiveForm::end(); ?>

</div>

