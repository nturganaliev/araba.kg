<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use common\models\Car;
use common\models\CarType;

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
    <div class="col-sm-24">
        <div class="form-group">
            <div class="row">
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
                    ->dropDownList(ArrayHelper::map(\common\models\Marka::find()->lorry()->all(), 'id', 'tname'), [
                        'prompt' => yii::t('app', 'Select ...'),
                        'id' => 'lorry-marka-id',
                    ])->error(false)
                ?>
                <?php
                echo $form->field($model, 'model_name', [
                    'options' => [
                        'class' => 'col-lg-8 col-md-8 col-sm-8'
                    ]
                ])->input('text')->error(false)
//        echo $form->field($model, 'model_id', [
//            'options' => [
//                'class' => 'col-lg-8 col-md-8 col-sm-8'
//            ],
//        ])->widget(DepDrop::classname(), [
//            'options' => [
//                'id' => 'lorry-model-id',
//                'placeholder' => yii::t('app', 'Select...'),
//            ],
//            'data' => ($model->marka_id == null) ? [] : ArrayHelper::map(common\models\CarModel::findAllMarkasSeries($model->marka_id), 'id', 'name'),
//            'pluginOptions' => [
//                'depends' => ['lorry-marka-id'],
//                'placeholder' => yii::t('app', 'Select...'),
//                'url' => yii\helpers\Url::to(['/car/series'])
//            ]
//        ]);
                ?>
                <?=
                $form->field($model, 'wheel_id', [
                    'options' => [
                        'class' => 'col-lg-8 col-md-8 col-sm-8'
                    ],
                ])->dropDownList(ArrayHelper::map(CarType::getWheelsByType(Car::CAR_TYPE_LORRY), 'id', 'tname'), [
                    'prompt' => yii::t('app', 'Select ...')
                ])->error(false)
                ?>
            </div>
        </div>
    </div>
    <div class="col-sm-24">
        <div class="form-group">
            <div class="row">
                <?=
                $form->field($model, 'kuzov_id', [
                    'options' => [
                        'class' => 'col-lg-8 col-md-8 col-sm-8'
                    ],
                ])->dropDownList(ArrayHelper::map(CarType::getKuzovsByType(Car::CAR_TYPE_LORRY), 'id', 'tname'), [
                    'prompt' => yii::t('app', 'Select ...')
                ])->error(false)
                ?>

                <?=
                $form->field($model, 'privod_id', [
                    'options' => [
                        'class' => 'col-lg-8 col-md-8 col-sm-8'
                    ],
                ])->dropDownList(ArrayHelper::map(CarType::getPrivodsByType(Car::CAR_TYPE_LORRY), 'id', 'tname'), [
                    'prompt' => yii::t('app', 'Select ...')
                ])->error(false)
                ?>

                <?=
                $form->field($model, 'transmission_id', [
                    'options' => [
                        'class' => 'col-lg-8 col-md-8 col-sm-8'
                    ],
                ])->dropDownList(ArrayHelper::map(CarType::getTransmissionsByType(Car::CAR_TYPE_LORRY), 'id', 'tname'), [
                    'prompt' => yii::t('app', 'Select ...')
                ])->error(false)
                ?>
            </div>
        </div>
    </div>
    <div class="col-sm-24">
        <div class="form-group">
            <div class="row">
                <?=
                $form->field($model, 'engine_id', [
                    'options' => [
                        'class' => 'col-lg-8 col-md-8 col-sm-8'
                    ],
                ])->dropDownList(ArrayHelper::map(CarType::getEnginesByType(Car::CAR_TYPE_LORRY), 'id', 'tname'), [
                    'prompt' => yii::t('app', 'Select ...')
                ])->error(false);
                ?>

                <?=
                $form->field($model, 'engine_displacement', [
                    'options' => [
                        'class' => 'col-lg-8 col-md-8 col-sm-8'
                    ],
                ])->input('number', [
                    'placeholder' => \Yii::t('app', 'К примеру 2 или 2.3'),
                    'step'  => '0.1'
                ])->error(false)
                ?>

                <?=
                $form->field($model, 'color_id', [
                    'options' => [
                        'class' => 'col-lg-8 col-md-8 col-sm-8'
                    ],
                ])->dropDownList(ArrayHelper::map(CarType::getColorsByType(Car::CAR_TYPE_LORRY), 'id', 'tname'), [
                    'prompt' => yii::t('app', 'Select ...')
                ])->error(false)
                ?>
            </div>
        </div>
    </div>
    <div class="col-sm-24">
        <div class="form-group">
            <div class="row">
                <?=
                $form->field($model, 'state_id', [
                    'options' => [
                        'class' => 'col-lg-8 col-md-8 col-sm-8'
                    ],
                ])->dropDownList(ArrayHelper::map(\common\models\State::find()->all(), 'id', 'tname'), [
                    'prompt' => yii::t('app', 'Select ...')
                ])->error(false);
                ?>

                <?=
                $form->field($model, 'region_id', [
                    'options' => [
                        'class' => 'col-lg-8 col-md-8 col-sm-8'
                    ],
                ])->dropDownList(ArrayHelper::map(\common\models\Region::find()->all(), 'id', 'tname'), [
                    'prompt' => yii::t('app', 'Select ...')
                ])->error(false);
                ?>

                <?=
                $form->field($model, 'price', [
                    'options' => [
                        'class' => 'col-lg-8 col-md-8 col-sm-8'
                    ],
                ])->input('number', [
                    'placeholder' => \Yii::t('app', 'в сомах')
                ])->error(false)
                ?>
            </div>
        </div>
    </div>
    <div class="col-sm-24">
        <div class="form-group">
            <div class="row">
                <?=
                $form->field($model, 'issue_date', [
                    'options' => [
                        'class' => 'col-lg-8 col-md-8 col-sm-8'
                    ],
                ])->dropDownList(\common\models\Car::getYears(), [
                    'prompt' => Yii::t('app', 'Select ...')
                ])->error(false);
                ?>

                <?=
                $form->field($model, 'run_length', [
                    'options' => [
                        'class' => 'col-lg-8 col-md-8 col-sm-8'
                    ],
                ])->input('number', [
                    'placeholder' => \Yii::t('app', 'К примеру 198000')
                ])->error(false)
                ?>

                <?=
                $form->field($model, 'loading_capacity', [
                    'options' => [
                        'class' => 'col-lg-8 col-md-8 col-sm-8'
                    ],
                ])->input('number', [
                    'placeholder' => \Yii::t('app', '4.5'),
                    'step'  => '0.1'
                ])->error(false)
                ?>

            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-24">
            <br>
            <p style="font-size: 16px"><strong><?= Yii::t('app', 'Complectation') ?></strong></p>
            <hr style="margin-top: -10px">
        </div>
        <?php
        $sets = ArrayHelper::map(CarType::getCompleteSetsByType(Car::CAR_TYPE_LORRY), 'id', 'tname');
        asort($sets);
        echo $form->field($model, 'completeSets', [
            'options' => [
                'class' => 'col-lg-24 col-md-24 col-sm-24'
            ]
        ])->checkboxList($sets, [
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
            <div class="col-sm-24">
                <br>
                <p style="font-size: 16px"><strong><?= Yii::t('app', 'Description') ?></strong></p>
                <hr style="margin-top: -10px">
            </div>
            <?=
            $form->field($model, 'description', [
                'options' => [
                    'class' => 'col-sm-24'
                ],
            ])->textarea(['rows' => 6])->label(false)->hint(Yii::t('app', '*Max 500 characters'))
            ?>
        </div>
        <div class="form-group">
            <div class="col-sm-24">
                <br>
                <p style="font-size: 16px"><strong><?= Yii::t('app', 'Photos') ?></strong></p>
                <hr style="margin-top: -10px">
            </div>
            <?php
            echo $form->field($model, 'images[]', [
                'options' => [
                    'class' => 'col-sm-24'
                ],
            ])->widget(FileInput::classname(), [
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
            ])->label(false);
            ?>
            <div class="col-lg-24 col-md-24 col-sm-24">
                <ul style="font-size: 12px; color: grey">
                    <li><?=Yii::t('app', 'Максимальное количество фотографий: 10')?></li>
                    <li><?=Yii::t('app', 'Максимальный размер одного файла: 4 MB')?></li>
                    <li><?=Yii::t('app', 'Поддерживаемые форматы файлов: .jpg, .jpeg, .png, .gif')?></li>
                </ul>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-24 col-md-24 col-sm-24">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php ActiveForm::end(); ?>

</div>

