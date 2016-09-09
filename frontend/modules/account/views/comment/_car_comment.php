<?php

use yii\timeago\TimeAgo;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
?>

<!--<div class="comment">-->
<div class="row">

    <div class="chat-wrapper">
        <div class="col-sm-6">
            <div class="pull-right">
            <!--<span class="sms-author">-->
                <?= $model->owner->username ?>
                <!--</span>-->

            </div>
        </div>
        <div class="col-sm-18">
            <div class="user-message">
                <?php
//                yii\widgets\Pjax::begin([
//                    'id' => 'pjax-comment-' . $model->id,
//                    'enablePushState' => false
//                ]);
                ?>
                <div class="message-content">
                    <?= $model->message ?>

                    <?php
                    echo Html::a(
                        '<span class="glyphicon glyphicon-remove"></span>', [
                        '/account/comment/delete',
                        'id' => $model->id
                        ], [
                        'id' => "comment-{$model->id}-remove",
//                        'data-pjax' => '#pjax-comment-' . $model->id,
                    ]);
                    ?>
                    <span class="sms-time pull-right">
                        <?=
                        date('d/m/Y H:i', $model->created_at);
                        ?>
                    </span>
                </div>
                <?php // yii\widgets\Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
<!--</div>-->
