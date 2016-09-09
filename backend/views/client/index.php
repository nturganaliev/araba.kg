<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\models\UserProfile;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Clients');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-index">

    <div class="panel panel-default">
        <div class="panel-body">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="panel-footer">
            <div class='pull-right'>
                <?= Html::submitButton(Yii::t('app', 'Filter'), ['class' => 'btn btn-primary', 'form' => 'client-search-form']) ?>
                <?= Html::a(Yii::t('app', 'Reset'), Url::to(['/client']), ['class' => 'btn btn-default', 'form' => 'client-search-form']) ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <?php
    yii\widgets\Pjax::begin([
        'id' => 'clients',
        'options' => ['class' => 'pjax-wraper']
    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-hover table-bordered table-condensed'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'user_id',
            'fio',
            'user.email:email',
            'company_name',
            'mobile_phone',
            'work_phone',
            'balance',
            [
                'attribute' => 'client_type',
                'filter' => UserProfile::getTypeOptions(),
                'value' => function($data) {
                    return $data->getTypeText();
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'buttons' => [
                    'view' => function($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to(['view', 'id' => $model->id]), [

                                'title' => 'Show Partner Detail',
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
