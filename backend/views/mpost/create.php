<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Mpost */

$this->title = Yii::t('app', 'Create Mpost');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Mposts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mpost-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
