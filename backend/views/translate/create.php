<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserProfile */

$this->title = Yii::t('app', 'Create new translation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Translations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="translate-create">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
