<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\models\Partner;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PartnerQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Partners');
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('/js/grid.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="partner-index">

    <p class="pull-right">
        <?=
        Html::button('<span class="glyphicon glyphicon-plus"></span> ' . Yii::t('app', 'Create Partner'), [
            'value' => Url::to(['create']),
            'form' => 'create-partner-form',
            'title' => Yii::t('app', 'Creating New Partner'),
            'class' => 'showModalButton btn btn-success'
        ]);
        ?>
    </p>

    <?php
    yii\widgets\Pjax::begin([
        'id' => 'partners',
        'options' => ['class' => 'pjax-wraper']
    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-hover table-bordered table-condensed'
        ],
        'rowOptions' => function ($model, $index, $widget, $grid) {
        if ($model->status == Partner::STATUS_DELETED) {
            return ['class' => 'danger'];
        } else {
            return [];
        }
    },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'format' => 'html',
                'attribute' => 'image',
                'value' => function($data) {
                    return Yii::$app->imageCache->thumb($data->getFilePath(), 'thumb', ['class' => 'img-thumbnail img-responsive']);
                }
                ],
                'title',
                [
                    'format' => 'raw',
                    'attribute' => 'url',
                    'value' => function($data) {
                        return Html::a($data->url, $data->url, ['target' => '_blank']);
                    }
                    ],
                    'description',
                    [
                        'format' => 'html',
                        'attribute' => 'status',
                        'filter' => Partner::getStatusOptions(),
                        'value' => function($data) {
                            if ($data->status == Partner::STATUS_ACTIVE) {
                                $url = Url::toRoute(['/partner/status-down', 'id' => $data->id]);
                                return Html::a('<span class="glyphicon glyphicon-ok-circle"></span>', $url, [
                                        'title' => Yii::t('app', 'Block'),
                                        'data-pjax' => 0, // нужно для отключения для данной ссылки стандартного обработчика pjax. Поверьте, он все портит
                                        'class' => 'grid-action' // указываем ссылке класс, чтобы потом можно было на него повесить нужный JS-обработчик
                                ]);
                            } else {
                                $url = Url::toRoute(['/partner/status-up', 'id' => $data->id]);
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
                            'template' => '{view} {update}',
                            'buttons' => [
                                'view' => function($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                                            'value' => Url::to(['view', 'id' => $model->id]),
                                            'form' => '',
                                            'title' => 'Show Partner Detail',
                                            'class' => 'showModalButton'
                                    ]);
                                }, 'update' => function($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-edit"></span>', '#', [
                                            'value' => Url::to(['update', 'id' => $model->id]),
                                            'form' => 'create-partner-form',
                                            'title' => 'Update Partner',
                                            'class' => 'showModalButton'
                                    ]);
                                }
                                ]
                            ],
                        ],
                    ]);
                    \yii\widgets\Pjax::end();
                    ?>

</div>
