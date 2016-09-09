<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BannerQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Banners');
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('/js/grid.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="banner-index">

    <p class="pull-right">
        <?=
        Html::button('Create Banner', [
            'value' => Url::to(['create']),
            'form' => 'create-banner-form',
            'title' => 'Creating New Banner',
            'class' => 'showModalButton btn btn-success'
        ]);
        ?>
    </p>


    <?php \yii\widgets\Pjax::begin(['options' => ['class' => 'pjax-wraper']]); ?>
    <?php if ($message = \yii::$app->session->getFlash('message')): ?>
        <script>
            alert('<?= $message ?>');
        </script>
    <?php endif; ?>
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            [
                'format' => 'raw',
                'attribute' => 'image',
                'filter' => false,
                'value' => function($data) {
                    return Yii::$app->imageCache->thumb($data->getFilePath(), 'thumb', ['class' => 'img-thumbnail img-responsive']);
                }
                ],
                [
                    'attribute' => 'page',
                    'value' => function($data) {
                        return $data->getPageText();
                    },
                    'filter' => common\models\Banner::getPageOptions()
                ],
                'url:url',
                [
                    'format' => 'raw',
                    'attribute' => 'position',
                    'filter' => false,
//                    'value' => function($data) {
//                        $urlUp = \yii\helpers\Url::toRoute(['/banner/position-up', 'id' => $data->id]);
//                        $urlDown = \yii\helpers\Url::toRoute(['/banner/position-down', 'id' => $data->id]);
//                        return $data->position . '&nbsp&nbsp&nbsp&nbsp&nbsp' . Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', $urlUp, [
//                                'title' => 'Вверх',
//                                'data-pjax' => 0, // нужно для отключения для данной ссылки стандартного обработчика pjax. Поверьте, он все портит
//                                'class' => 'grid-action' // указываем ссылке класс, чтобы потом можно было на него повесить нужный JS-обработчик
//                            ]) . ' ' . Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', $urlDown, [
//                                'title' => 'Вниз',
//                                'data-pjax' => 0, // нужно для отключения для данной ссылки стандартного обработчика pjax. Поверьте, он все портит
//                                'class' => 'grid-action' // указываем ссылке класс, чтобы потом можно было на него повесить нужный JS-обработчик
//                        ]);
//                    }
                ],
                // 'created_by',
                // 'updated_by',
                // 'created_at',
                // 'updated_at',
                [// Здесь начинается описание колонки действий
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{order-up} {order-down}',
                    'buttons' => [
                        'order-up' => function($url, $model) {
                            $url = \yii\helpers\Url::toRoute(['/banner/position-up', 'id' => $model->id]);
                            return Html::a('<span class="glyphicon glyphicon-arrow-up"></span>', $url, [
                                    'title' => 'Вверх',
                                    'data-pjax' => 0, // нужно для отключения для данной ссылки стандартного обработчика pjax. Поверьте, он все портит
                                    'class' => 'grid-action' // указываем ссылке класс, чтобы потом можно было на него повесить нужный JS-обработчик
                            ]);
                        },
                            'order-down' => function($url, $model) {
                            $url = \yii\helpers\Url::toRoute(['/banner/position-down', 'id' => $model->id]);
                            return Html::a('<span class="glyphicon glyphicon-arrow-down"></span>', $url, [
                                    'title' => 'Вниз',
                                    'data-pjax' => 0, // нужно для отключения для данной ссылки стандартного обработчика pjax. Поверьте, он все портит
                                    'class' => 'grid-action' // указываем ссылке класс, чтобы потом можно было на него повесить нужный JS-обработчик
                            ]);
                        }
                        ]
                    ],
                    [
                        'attribute' => 'status',
                        'filter' => common\models\Banner::getStatusOptions(),
                        'value' => function($data) {
                            return $data->getStatusText();
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
                                        'title' => Yii::t('app', 'Show Banner Detail'),
                                        'class' => 'showModalButton'
                                ]);
                            }, 'update' => function($url, $model, $key) {
                                return Html::a('<span class="glyphicon glyphicon-edit"></span>', '#', [
                                        'value' => Url::to(['update', 'id' => $model->id]),
                                        'form' => 'create-banner-form',
                                        'title' => 'Update Banner',
                                        'class' => 'showModalButton'
                                ]);
                            },
                            ]
                        ],
                    ],
                ]);
                \yii\widgets\Pjax::end();
                ?>

</div>
