<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<?php

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_images_itemview',
    'layout' => "{items}\n{pager}",
    'viewParams' => [
        'carId' => $carId
    ]
//    'separator' => "<hr style='margin: 1px'>"
]);
?>
