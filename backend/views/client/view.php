<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UserProfile;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */

$this->title = $model->fio;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Client profile'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-view">

    <div class="row">
        <div class="col-sm-12">
            <?php
            if ($model->client_type == UserProfile::CLIENT_TYPE_LEG) {
                $attributes = [
                    'user_id',
                    'fio',
                    'user.email:email',
                    'company_name',
                    'mobile_phone',
                    'work_phone',
                    [
                        'attribute' => 'client_type',
                        'value' => $model->getTypeText()
                    ],
                    'balance',
                ];
            } else {
                $attributes = [
                    'user_id',
                    'fio',
                    'user.email:email',
                    'mobile_phone',
                    [
                        'attribute' => 'client_type',
                        'value' => $model->getTypeText()
                    ],
                    [
                        'attribute' => 'balance',
                        'value' => "{$model->balance} сом",
                    ],
                ];
            }
            ?>
            <?php
            yii\widgets\Pjax::begin([
                'id' => 'user-detail',
                'timeout' => 3000,
                'enablePushState' => false
            ]);
            ?>
            <div class="panel panel-default">
                <?php
                echo DetailView::widget([
                    'model' => $model,
                    'options' => [
                        'class' => 'table table-striped table-bordered table-condensed detail-view'
                    ],
                    'attributes' => $attributes
                ]);
                ?>
            </div>
            <?php yii\widgets\Pjax::end(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php
            $label = $this->render('_form_refill', [
                'clientId' => $model->id,
                'model' => new common\models\Transaction()
            ]);
            echo $this->render('_index_payments', [
                'clientId' => $model->id,
                'dataProvider' => $dataProvider,
                'model' => new common\models\Transaction()
            ]);
            ?>
        </div>
    </div>
</div>
