<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use common\models\Banner;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="stylesheet" type="text/css" href="/css/cars/flaticon.css">
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Chau+Philomene+One">

        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <?php
        NavBar::begin([
            'id' => 'main_navbar',
            'brandLabel' => '<span class="araba">ARABA</span>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-default navbar-static-top',
            ],
        ]);
        $menuItems = [
            ['label' => '<label class="label label-success label-add-advertisement">' . yii::t('app', 'Add advertisement') . '</label>', 'url' => ['/account/car/create']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => yii::t('app', 'Enter'), 'url' => ['/site/signup']];
//				$menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $menuItems[] = [
                'label' => Yii::$app->user->identity->email, 'url' => ['/account/car']];
            $menuItems[] = [
                'label' => Yii::t('app', 'Logout'),
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];
        }
        $menuItems[] = [
            'label' => Yii::t('app', 'Language'),
            'items' => [
                ['label' => 'english', 'url' => ['/site/change-lang', 'lang' => 'en']],
                ['label' => 'русский', 'url' => ['/site/change-lang', 'lang' => 'ru']],
                ['label' => 'кыргызча', 'url' => ['/site/change-lang', 'lang' => 'ky']]
            ]
        ];
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav pull-right'],
            'items' => $menuItems,
            'encodeLabels' => false,
        ]);
        NavBar::end();
        ?>
        <div class="site-search">
            <div class="row">
                <div class='col-sm-24'>
                    <?php
                    $imageModel = Banner::find()->where(['position' => 1])->active()->mainPage()->one();
                    if ($imageModel) {
                    ?>
                        <div style=" background-image: url(<?= Yii::getAlias('@admin_url') ?>/uploads/<?= $imageModel->image ?>);
                                    background-repeat: repeat-x;
                             /*                             background-size:contain;
                                                          background-position:center;*/

                             ">
                                 <?php
/*                        $imageUrl = Yii::getAlias('@admin_url')."/uploads/{$imageModel->image}";
                                echo Html::a(Html::img($imageUrl, ['class' => 'img-responsive']), $imageModel->url, [
                                'target' => '_blank',
                                'usemap' => '#mapname'
                            ]);*/
//                        echo Html::img($imageUrl, [
//                            'class' => 'img-responsive',
//                            'usemap' => '#mapname'
//                        ]);
                             } else {
                                 ?>
                            <div>
                                <?php
                            }
                            ?>


                            <p>&nbsp;</p>
                            <div class="container">
                                <div class='row'>
                                    <div class="col-sm-12">
                                        <p>
                                            <?php
                                            echo $this->render('/car/_search', [
                                                'modelAutomobile' => new \common\models\AutomobileQuery(),
                                                'modelBus' => new \common\models\BusQuery(),
                                                'modelLorry' => new \common\models\LorryQuery(),
                                                'modelMoto' => new \common\models\MotocycleQuery(),
                                                'modelSQ' => new \common\models\SpecialEquipmentQuery()
                                            ]);
                                            ?>

                                        </p>
                                    </div>
                                    <div class="col-sm-12" style="height: 250px; cursor: pointer" <?php if ($imageModel){ if ($imageModel->url) { ?> onclick="window.open('<?= $imageModel->url ?>','_blank'); return false" <?php }}?>>
                                        <p>

                                        </p>
                                    </div>
                                    <div style="clear: both"></div>
                                </div>
                            </div>
                            <p>&nbsp;</p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container">
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>

            <footer class="footer">
                <div class="container">
                    <p class="pull-left">&copy; araba.kg <?= date('Y') ?></p>
                </div>
            </footer>

            <?php $this->endBody() ?>
            <?php
            yii\bootstrap\Modal::begin([
                'headerOptions' => ['id' => 'modalHeader'],
                'id' => 'modal',
                'size' => 'modal-md',
                'footerOptions' => ['id' => 'modalFooter'],
                'footer' => '<button id="modalSubmitButton" type="submit" class="btn btn-primary" form="">' . Yii::t('app', 'Save') . '</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">' . Yii::t('app', 'Close') . '</button>',
                //keeps from closing modal with esc key or by clicking out of the modal.
                // user must click cancel or X to close
                'clientOptions' => ['backdrop' => 'static', 'keyboard' => true]
            ]);
            echo "<div id='modalContent'></div>";
            yii\bootstrap\Modal::end();
            ?>
    </body>
</html>
<?php $this->endPage() ?>
