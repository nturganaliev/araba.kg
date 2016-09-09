<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OfficeQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Offices');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="office-index">

    <p class="pull-right">
        <?=
        Html::button('Create Office', [
            'value' => Url::to(['create']),
            'form' => 'create-office-form',
            'title' => 'Creating New Office',
            'class' => 'showModalButton btn btn-success'
        ]);
        ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-hover table-bordered table-condensed'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'address',
//            'created_at',
//            'updated_at',
            // 'created_by',
            // 'updated_by',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {employees}',
                'buttons' => [
                    'view' => function($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                                'value' => Url::to(['view', 'id' => $model->id]),
                                'form' => '',
                                'title' => 'Офис',
                                'class' => 'showModalButton'
                        ]);
                    }, 'update' => function($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-edit"></span>', '#', [
                                'value' => Url::to(['update', 'id' => $model->id]),
                                'form' => 'create-office-form',
                                'title' => 'Update Office',
                                'class' => 'showModalButton'
                        ]);
                    }, 'employees' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-th-list"></span>', Url::to(['/user', 'UserProfileQuery[office_id]' => $model->id]), [
                                'title' => Yii::t('app', 'Users'),
                        ]);
                    }
                    ]
                ],
            ],
        ]);
        ?>

</div>
