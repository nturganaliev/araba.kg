<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AutomobileQuery */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Automobiles');
?>

<div class="row">
    <div class="col-lg-2">
        <?php echo $this->render('_sidebar'); ?>
    </div>
    <div class="col-lg-10">
        <?php
        echo $this->render('/car/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
        ?>
    </div>
</div>
