<?php

use yii\timeago\TimeAgo;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
?>

<!--<div class="comment">-->
<div class="chat-wrapper">
    <div class="user-name">
        <span class="sms-author">
            <?= $model->owner->username ?>
        </span>

    </div>
    <div class="user-message">
        <div class="message-content">

            <?= $model->message ?>
            <?php
            echo Html::a(
                '<span class="glyphicon glyphicon-remove"></span>', [
                '/account/comment/delete',
                'id' => $model->id
                ], [
                'id' => "comment-{$model->id}-remove",
                'data-pjax' => false,
            ]);
            ?>
            <span class="sms-time pull-right">
                <?=
                TimeAgo::widget([
                    'timestamp' => date(DATE_ISO8601, $model->created_at),
                    'language' => 'ru',
                ]);
                ?>
            </span>
        </div>
    </div>
</div>
<!--</div>-->
