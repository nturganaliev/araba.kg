<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Partner */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'Partner',
    ]) . ' ' . $model->title;
?>
<div class="partner-update">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
