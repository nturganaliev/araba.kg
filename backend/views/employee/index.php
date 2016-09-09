<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use backend\models\Employee;
use backend\models\EmployeeProfile;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EmployeeProfileQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Profiles');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('/js/grid.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="user-profile-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="pull-right">
        <?php
        Modal::begin([
            'header' => '<strong>' . Yii::t('app', 'New user') . '</strong>',
            'footer' => '<input type="submit" class="btn btn-primary" value="' . Yii::t('app', 'Save changes') . '" form="new_user_form" />
            <button type="button" class="btn btn-default" data-dismiss="modal">' . Yii::t('app', 'Cancel') . '</button>',
            'toggleButton' => [
                'tag' => 'button',
                'class' => 'btn btn-info',
                'label' => '<span class="glyphicon glyphicon-plus"></span> ' . \yii::t('app', 'New user'),
            ]
        ]);

        echo $this->render('_create_form', [
            'model' => $model,
        ]);

        Modal::end();
        ?>
    </p>

    <?php
    yii\widgets\Pjax::begin([
        'id' => 'users',
        'options' => ['class' => 'pjax-wraper']
    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-hover table-bordered table-condensed'
        ],
        'rowOptions' => function ($model, $index, $widget, $grid) {
        if ($model->user->status == Employee::STATUS_DELETED) {
            return ['class' => 'danger'];
        } else {
            return [];
        }
    },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            [
                'attribute' => 'office_id',
                'filter' => yii\helpers\ArrayHelper::map(\backend\models\Office::find()->orderBy('name')->all(), 'id', 'name'),
                'value' => function($data) {
                    return $data->office->name;
                }
            ],
            'fio',
            [
                'attribute' => 'email',
                'format' => 'email',
                'value' => function($data) {
                    return $data->user->email;
                }
            ],
            'phone',
            [
                'attribute' => 'role',
                'filter' => EmployeeProfile::getRolesOptions(),
                'value' => function($data) {
                    return $data->getRoleText();
                }
            ],
            [
                'format' => 'html',
                'attribute' => 'status',
                'filter' => Employee::getStatusOptions(),
                'value' => function($data) {
                    if ($data->user->status == Employee::STATUS_ACTIVE) {
                        $url = \yii\helpers\Url::toRoute(['status-down', 'id' => $data->user->id]);
                        return Html::a('<span class="glyphicon glyphicon-ok-circle"></span>', $url, [
                                'title' => Yii::t('app', 'Block'),
                                'data-pjax' => 0, // нужно для отключения для данной ссылки стандартного обработчика pjax. Поверьте, он все портит
                                'class' => 'grid-action' // указываем ссылке класс, чтобы потом можно было на него повесить нужный JS-обработчик
                        ]);
                    } else {
                        $url = \yii\helpers\Url::toRoute(['status-up', 'id' => $data->user->id]);
                        return Html::a('<span class="glyphicon glyphicon-remove-circle"></span>', $url, [
                                'title' => Yii::t('app', 'Activate'),
                                'data-pjax' => 0, // нужно для отключения для данной ссылки стандартного обработчика pjax. Поверьте, он все портит
                                'class' => 'grid-action' // указываем ссылке класс, чтобы потом можно было на него повесить нужный JS-обработчик
                        ]);
                    }
                }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {update_password}',
                    'buttons' => [
                        'view' => function($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                                    'value' => Url::to(['view', 'id' => $model->user->id]),
                                    'form' => '',
                                    'size' => 'modal-lg',
                                    'title' => Yii::t('app', 'Show detail'),
                                    'class' => 'showModalButton'
                            ]);
                        }, 'update' => function($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-edit"></span>', '#', [
                                    'value' => Url::to(['update-profile', 'id' => $model->user->id]),
                                    'form' => 'update-profile-form',
                                    'title' => 'Update profile',
                                    'class' => 'showModalButton'
                            ]);
                        }, 'update_password' => function($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-asterisk"></span>', '#', [
                                    'value' => Url::to(['update-password', 'id' => $model->user->id]),
                                    'form' => 'update-password-form',
                                    'size' => 'modal-sm',
                                    'title' => 'Update password',
                                    'class' => 'showModalButton'
                            ]);
                        }
                        ]
                    ],
                ],
            ]);
            yii\widgets\Pjax::end();
            ?>


</div>
