<?php
/* @var $this yii\web\View */
/* @var $model common\models\Automobile */
?>

<div>
    <p><?= $model->marka->name ?>
        <?= $model->carModel->name ?>
        <?= $model->kuzov->name ?>
        <?= $model->color->name ?>
        <?= $model->transmission->name ?>
        <?= $model->privod->name ?>
        <?= $model->price ?></p>
</div>

