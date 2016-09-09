<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\timeago\TimeAgo;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CommentQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = Yii::t('app', 'Comments');
//$this->registerCssFile(Url::to('/css/comments.css'));
?>

<p style="display: none;"><?=
    TimeAgo::widget([
        'timestamp' => date(DATE_ISO8601, time()),
        'language' => 'ru',
    ]);
    ?></p>
<div class="comment-index">
    <?php
    Pjax::begin([
        'id' => 'comments-list',
        'timeout' => 3000,
        'enablePushState' => false
    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'showHeader' => false,
//        'layout' => '{summary}\n{items}\n{pager}',
        'layout' => "{items}\n{pager}",
        'tableOptions' => ['class' => 'table'],
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
//            'id',
//            'car_id',
//            'user_id',
            [
                'attribute' => 'created_at',
                'format' => 'raw',
                'value' => function($data) {
                    return $this->render('/comment/_car_comment', [
                            'comment' => $data,
                    ]);
                }
                ],
            ],
        ]);
        Pjax::end();
        ?>

    </div>
    <?php if (Yii::$app->user->isGuest) : ?>
        <div class="aaa" >
            <p>You must be authenticated to made comment.</p>
        </div>
    <?php else : ?>
        <?php
        echo $this->render('_form', [
            'model' => $model,
            'carId' => $carId,
        ]);
        ?>
    <?php endif; ?>
</div>
