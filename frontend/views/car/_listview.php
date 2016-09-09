<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\timeago\TimeAgo;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AutomobileQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$sort = $dataProvider->sort;
?>
<br/>
<p class="pull-right" style="font-size: 13px;">
    <?= $sort->link('created_at') . ' | ' . $sort->link('price') . ' | ' . $sort->link('issue_date'); ?>
</p>
<?php
echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_itemview',
    'separator' => "<hr style='margin: 1px'>",
    'layout' => "<div style='font-size: 13px;'>{summary}</div>\n{items}\n<div class='pagination-wrapper'>{pager}</div>",
]);
?>
