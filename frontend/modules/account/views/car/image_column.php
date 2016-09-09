<?php

use yii\helpers\Html;
?>

<div class="carWrapper">
    <?=
    Html::img(yii\helpers\Url::to('/images/test.jpg'), [
        'class' => 'img-thumbnail img-rounded',
        'width' => 200
    ]);
    ?>
</div>