<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use dosamigos\selectize\SelectizeTextInput;

/* @var $this yii\web\View */
/* @var $model common\models\CarType */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Car Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-type-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="pull-right">
                        <button class="btn btn-xs btn-default" form="colors-update-form">
                            <span class="glyphicon glyphicon-refresh"></span>
                        </button>
                    </span>
                    <h3 class="panel-title"><?= Yii::t('app', 'Colors') ?></h3>
                </div>
                <div class="panel-body">
                    <?php
                    yii\widgets\Pjax::begin([
                        'id' => 'colors-pjax',
                        'enablePushState' => 0
                    ]);
                    ?>
                    <?=
                    $this->render('_form_colors_update', [
                        'model' => $model,
                    ])
                    ?>
                    <?php yii\widgets\Pjax::end(); ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="pull-right">
                        <button class="btn btn-xs btn-default" form="wheels-update-form">
                            <span class="glyphicon glyphicon-refresh"></span>
                        </button>
                    </span>
                    <h3 class="panel-title"><?= Yii::t('app', 'Wheels') ?></h3>
                </div>
                <div class="panel-body">
                    <?php
                    yii\widgets\Pjax::begin([
                        'id' => 'wheels-pjax',
                        'enablePushState' => 0
                    ]);
                    ?>
                    <?=
                    $this->render('_form_wheels_update', [
                        'model' => $model,
                    ])
                    ?>
                    <?php yii\widgets\Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="pull-right">
                        <button class="btn btn-xs btn-default" form="engines-update-form">
                            <span class="glyphicon glyphicon-refresh"></span>
                        </button>
                    </span>
                    <h3 class="panel-title"><?= Yii::t('app', 'Engines') ?></h3>
                </div>
                <div class="panel-body">
                    <?php
                    yii\widgets\Pjax::begin([
                        'id' => 'engines-pjax',
                        'enablePushState' => 0
                    ]);
                    ?>
                    <?=
                    $this->render('_form_engines_update', [
                        'model' => $model,
                    ])
                    ?>
                    <?php yii\widgets\Pjax::end(); ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="pull-right">
                        <button class="btn btn-xs btn-default" form="kuzovs-update-form">
                            <span class="glyphicon glyphicon-refresh"></span>
                        </button>
                    </span>
                    <h3 class="panel-title"><?= Yii::t('app', 'Kuzovs') ?></h3>
                </div>
                <div class="panel-body">
                    <?php
                    yii\widgets\Pjax::begin([
                        'id' => 'kuzovs-pjax',
                        'enablePushState' => 0
                    ]);
                    ?>
                    <?=
                    $this->render('_form_kuzovs_update', [
                        'model' => $model,
                    ])
                    ?>
                    <?php yii\widgets\Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="pull-right">
                        <button class="btn btn-xs btn-default" form="privods-update-form">
                            <span class="glyphicon glyphicon-refresh"></span>
                        </button>
                    </span>
                    <h3 class="panel-title"><?= Yii::t('app', 'Privods') ?></h3>
                </div>
                <div class="panel-body">
                    <?php
                    yii\widgets\Pjax::begin([
                        'id' => 'privods-pjax',
                        'enablePushState' => 0
                    ]);
                    ?>
                    <?=
                    $this->render('_form_privods_update', [
                        'model' => $model,
                    ])
                    ?>
                    <?php yii\widgets\Pjax::end(); ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="pull-right">
                        <button class="btn btn-xs btn-default" form="transmissions-update-form">
                            <span class="glyphicon glyphicon-refresh"></span>
                        </button>
                    </span>
                    <h3 class="panel-title"><?= Yii::t('app', 'Transmissions') ?></h3>
                </div>
                <div class="panel-body">
                    <?php
                    yii\widgets\Pjax::begin([
                        'id' => 'transmissions-pjax',
                        'enablePushState' => 0
                    ]);
                    ?>
                    <?=
                    $this->render('_form_transmissions_update', [
                        'model' => $model,
                    ])
                    ?>
                    <?php yii\widgets\Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="pull-right">
                        <button class="btn btn-xs btn-default" form="complete-sets-update-form">
                            <span class="glyphicon glyphicon-refresh"></span>
                        </button>
                    </span>
                    <h3 class="panel-title"><?= Yii::t('app', 'Complete Sets') ?></h3>
                </div>
                <div class="panel-body">
                    <?php
                    yii\widgets\Pjax::begin([
                        'id' => 'complete-sets-pjax',
                        'enablePushState' => 0
                    ]);
                    ?>
                    <?=
                    $this->render('_form_complete_sets_update', [
                        'model' => $model,
                    ])
                    ?>
                    <?php yii\widgets\Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
