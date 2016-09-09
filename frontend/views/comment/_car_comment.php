<?php

use yii\timeago\TimeAgo;
use yii\helpers\ArrayHelper;

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
                <div class="message-content">
                    <?= $model->message ?>
                    <span class="sms-time pull-right">
                        <?=
                        date('d/m/Y H:i', $model->created_at);
//                        TimeAgo::widget([
//                            'timestamp' => date(DATE_ISO8601, $model->created_at),
//                            'language' => 'ru',
//                        ]);
                        ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<!--</div>-->
