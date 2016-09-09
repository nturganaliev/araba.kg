<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\models\Tarrif;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TarrifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tarrifs');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('/js/grid.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="tarrif-index">

    <p class="pull-right">
        <?=
        Html::button('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'Create Tarrif'), [
            'value' => Url::to(['create']),
            'form' => 'create-tarrif-form',
            'title' => Yii::t('app', 'Creating New Tarrif'),
            'class' => 'showModalButton btn btn-success'
        ]);
        ?>
    </p>

    <?php
    yii\widgets\Pjax::begin([
        'id' => 'tarrifs',
        'options' => ['class' => 'pjax-wraper']
    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-hover table-bordered table-condensed'
        ],
        'rowOptions' => function ($model, $index, $widget, $grid) {
        if ($model->status == Tarrif::STATUS_DELETED) {
            return ['class' => 'danger'];
        } else {
            return [];
        }
    },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            'title',
            'day_count',
            'price',
            'description',
            [
                'format' => 'html',
                'attribute' => 'status',
                'filter' => Tarrif::getStatusOptions(),
                'value' => function($data) {
                    if ($data->status == Tarrif::STATUS_ACTIVE) {
                        $url = Url::toRoute(['/tarrif/status-down', 'id' => $data->id]);
                        return Html::a('<span class="glyphicon glyphicon-ok-circle"></span>', $url, [
                                'title' => Yii::t('app', 'Block'),
                                'data-pjax' => 0, // нужно для отключения для данной ссылки стандартного обработчика pjax. Поверьте, он все портит
                                'class' => 'grid-action' // указываем ссылке класс, чтобы потом можно было на него повесить нужный JS-обработчик
                        ]);
                    } else {
                        $url = Url::toRoute(['/tarrif/status-up', 'id' => $data->id]);
                        return Html::a('<span class="glyphicon glyphicon-remove-circle"></span>', $url, [
                                'title' => Yii::t('app', 'Activate'),
                                'data-pjax' => 0, // нужно для отключения для данной ссылки стандартного обработчика pjax. Поверьте, он все портит
                                'class' => 'grid-action' // указываем ссылке класс, чтобы потом можно было на него повесить нужный JS-обработчик
                        ]);
                    }
                }
                ],
                // 'created_by',
                // 'updated_by',
                // 'created_at',
                // 'updated_at',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update}',
                    'buttons' => [
                        'view' => function($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                                    'value' => Url::to(['view', 'id' => $model->id]),
                                    'form' => '',
                                    'title' => 'Show Tarrif Detail',
                                    'class' => 'showModalButton'
                            ]);
                        }, 'update' => function($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-edit"></span>', '#', [
                                    'value' => Url::to(['update', 'id' => $model->id]),
                                    'form' => 'create-tarrif-form',
                                    'title' => 'Update Tarrif',
                                    'class' => 'showModalButton'
                            ]);
                        }, 'delete' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                    'title' => Yii::t('yii', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                    'data-method' => 'post',
                                    'class' => 'showModalButton',
                                    'data-pjax' => '0',
                            ]);
                        }
                        ]
                    ],
                ],
            ]);
            \yii\widgets\Pjax::end();
            ?>

</div>
