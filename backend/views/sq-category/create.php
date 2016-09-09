<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SqCategory */

$this->title = Yii::t('app', 'Create Sq Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sq Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sq-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
