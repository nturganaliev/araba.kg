<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CommentQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = Yii::t('app', 'Comments');
//$this->registerCssFile(Url::to('/css/comments.css'));
?>

<div class="payments">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?php
            echo $this->render('_form_refill', [
                'clientId' => $clientId,
                'model' => $model
            ]);
            ?>
        </div>

        <?php
        Pjax::begin([
            'id' => 'payments-list',
            'timeout' => 3000,
            'enablePushState' => true
        ]);
        if (Yii::$app->session->hasFlash('payment_success')) {
            ?>
            <script>
                alert('<?= Yii::$app->session->getFlash('payment_success') ?>');
            </script>
            <?php
        }
        echo GridView::widget([
            'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
            'showHeader' => TRUE,
            'pager' => [
//                'firstPageLabel' => 'First',
//                'prevPageLabel' => '<span class="glyphicon glyphicon-log-in"></span>',
//                'nextPageLabel' => '>',
//                'lastPageLabel' => 'Last',
                'options' => [
                    'class' => 'pagination pagination-sm'
                ]
            ],
            'layout' => "{items}\n{pager}",
            'tableOptions' => ['class' => 'table table-condensed table-hover'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
//            'id',
                'client.fio',
                'cashier.fio',
                'amount',
                'created_at:datetime',
            ],
        ]);
        Pjax::end();
        ?>

    </div>
</div>

