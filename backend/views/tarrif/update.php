<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tarrif */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
        'modelClass' => 'Tarrif',
    ]) . ' ' . $model->title;
?>
<div class="tarrif-update">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
