<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Banner;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveFornnm */
/* @var $modelIndividualClient \frontend\models\SignupFormIndividualClient */
/* @var $modelLegalClient \frontend\models\SignupFormLegalClient */
/* @var $modelLoginForm \common\models\LoginForm */
/* @var $type Int */
$this->title = yii::t('app', 'Registration/Enter');
?>
<div class="site-signup">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div style="margin-top: 20px">
                <?php
                if ($imageModel = Banner::find()->where('page=:page', [':page' => Banner::PAGE_ENTER_REGISTER])->active()->limit(1)->one()):
                    ?>
                    <?php $imageUrl = Yii::getAlias('@admin_url'). "/uploads/{$imageModel->image}"; ?>
                    <?=
                    Html::a(Html::img($imageUrl, ['class' => 'img-responsive']), $imageModel->url, [
                        'target' => '_blank'
                    ]);
                    ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-lg-24 col-md-24 col-sm-24">

                    <h3><?= yii::t('app', 'If you have account'); ?></h3>
                    <div class="panel panel-default">

                        <div class="login-panel">
                            <div class="panel-body">
                                <?= $this->render('_login', ['model' => $modelLoginForm]); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-24 col-md-24 col-sm-24">
                    <h3><?= yii::t('app', 'if you dont yet registered') ?></h3>
                    <div role = "tabpanel" id = "registration-tablist">
                        <ul class = "nav nav-tabs" role = "tablist">
                            <li role = "presentation"
                            <?php if ($type == 0): ?>
                                    class = "active"
                                <?php endif; ?>
                                ><a href = "#individualClientTab" aria-controls = "individualClient" role = "tab" data-toggle = "tab"><?= yii::t('app', 'Individual client') ?></a></li>
                            <li role="presentation"
                            <?php if ($type == 1): ?>
                                    class = "active"
                                <?php endif; ?>
                                ><a href="#legalClientTab" aria-controls="legalClient" role="tab" data-toggle="tab"><?= yii::t('app', 'Legal client') ?></a></li>
                        </ul>

                        <div class="tab-content">
                            <div role="tabpanel" <?php if ($type == 0): ?>
                                     class="tab-pane active"
                                 <?php else: ?>
                                     class="tab-pane"
                                 <?php endif; ?>  id="individualClientTab">
                                 <?= $this->render('_signupFormIndividualClient', ['model' => $modelIndividualClient]) ?>
                            </div>
                            <div role="tabpanel"  <?php if ($type == 1): ?>
                                     class="tab-pane active"
                                 <?php else: ?>
                                     class="tab-pane"
                                 <?php endif; ?> id="legalClientTab">
                                <?= $this->render('_signupFormLegalClient', ['model' => $modelLegalClient]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
Modal::begin([
    'id' => 'using-rule-modal',
    'header' => '<h4>' . Yii::t('app', 'Terms of use') . '</h4>',
//    'toggleButton' => ['label' => 'click me'],
]);

Modal::end();
?>
<br>
