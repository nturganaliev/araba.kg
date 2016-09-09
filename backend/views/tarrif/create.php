<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Tarrif */

$this->title = Yii::t('app', 'Create Tarrif');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tarrifs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tarrif-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
