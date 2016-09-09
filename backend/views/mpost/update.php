<?php

use yii\helpers\Html;
use common\models\Mpost;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Mpost */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'Post',
    ]) . ' ' . $model->post->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['/post']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="mpost-update">
    <div class="panel panel-default">
        <div class="panel-heading">
            <ul class="nav nav-pills pull-right">
                <li role="presentation" <?php if ($model->lang == 'en') echo 'class="active"' ?>><a href="<?= Url::to(['/post/mpost-update', 'id' => $model->post_id, 'lang' => 'en']) ?>"><?= Mpost::getLangOptions()['en'] ?></a></li>
                <li role="presentation" <?php if ($model->lang == 'ky') echo 'class="active"' ?>><a href="<?= Url::to(['/post/mpost-update', 'id' => $model->post_id, 'lang' => 'ky']) ?>"><?= Mpost::getLangOptions()['ky'] ?></a></li>
                <li role="presentation" <?php if ($model->lang == 'ru') echo 'class="active"' ?>><a href="<?= Url::to(['/post/mpost-update', 'id' => $model->post_id, 'lang' => 'ru']) ?>"><?= Mpost::getLangOptions()['ru'] ?></a></li>
            </ul>
            <h5><?= Html::encode($this->title) ?></h5>
            <div class="clearfix"></div>
        </div>

        <div class="panel-body">
            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>
        </div>
    </div>

</div>
