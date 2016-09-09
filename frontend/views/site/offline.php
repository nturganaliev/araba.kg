<?php

use yii\helpers\Html;
?>
<div class="site-offline">
    <h1>Site under constraction!</h1>
    <p>
        <?= Yii::getAlias('@adv_upload_path') ?>
    </p>
    <p>
        <?= Yii::getAlias('@app') ?>
    </p>
    <p>
        <?= Yii::getAlias('@webroot') ?>
    </p>
    <p>
        <?=
        Yii::$app->imageCache->thumb(Yii::getAlias('@adv_upload_path') . '/' . '55553c005dc7a.jpg', 'medium', [
            'class' => 'img-thumbnail img-responsive'
        ]);
        ?>

    </p>
    <p>
        <?=
        Html::a(Yii::$app->imageCache->thumb(Yii::getAlias('@adv_upload_path') . '/' . '55553c005dc7a.jpg', 'medium', [
                'class' => 'img-thumbnail img-responsive'
            ]), '/thumbs/' . '55553c005ff58_thumb.jpg', [
            'rel' => 'prettyPhoto[pp_gal]'
        ]);
        ?>
    </p>
</div>
