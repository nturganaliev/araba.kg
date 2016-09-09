<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\popover\PopoverX;
use kartik\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use common\models\UserProfile;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = \yii::t('app', 'Settings');
?>
<div class="automobile-view">
    <div class="row">
        <div class="col-lg-4">
            <?php
            $user = \yii::$app->user->identity;
            ?>
            <ul class="list-group">
                <li class="list-group-item">
                    <?php if ($user->profile->client_type == 1) {?><b><?= $user->profile->company_name ?></b><br><?php }?>
                    <?= $user->profile->fio ?><br>
                    <?= isset($user->profile->work_phone) ? $user->profile->work_phone.'<br>' : ''?>
                    <?= $user->profile->mobile_phone ?><br>
                </li>
                <li class="list-group-item">
                    <?= \yii\helpers\Html::a(yii::t('app', 'Cars'), \yii\helpers\Url::to('/account/car')) ?>
                </li>
                <li class="list-group-item">
                    <?= \yii::t('app', 'Settings') ?>
                </li>
                <li class="list-group-item">
                    <?= \yii\helpers\Html::a(yii::t('app', 'Refill balance'), \yii\helpers\Url::to('/account/refill-balance')) ?>
                </li>
            </ul>
        </div>

        <div class="col-lg-20">
            <p class="pull-right">
                <?php
                Modal::begin([
                    'header' => '<strong>' . Yii::t('app', 'Edit user profile') . '</strong>',
                    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" value="' . Yii::t('app', 'Save changes') . '" onclick="$(\'#update-user-settings-form\').trigger(\'beforeSubmit\');" />',
                    'toggleButton' => [
                        'tag' => 'button',
                        'class' => 'btn btn-info',
                        'label' => \yii::t('app', 'Update'),
                    ]
                ]);

                echo $this->render('_userSettingForm', [
                    'model' => $model,
                ]);

                Modal::end();
                ?>
            </p>
            <div class="clearfix"></div>

            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'companyName',
                        'visible' => $model->type == UserProfile::CLIENT_TYPE_LEG,
                    ],
                    'fio',
                    'email',
                    [
                        'attribute' => 'workPhone',
                        'visible' => $model->type == UserProfile::CLIENT_TYPE_LEG,
                    ],
                    'mobilePhone',
                    [
                        'format' => 'raw',
                        'attribute' => 'password',
                        'value' => $this->render('_changePasswordModal')
                    ]
                ],
            ]);
            ?>

        </div>
    </div>
</div>
