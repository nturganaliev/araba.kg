<?php

use yii\bootstrap\Tabs;
use frontend\models\ContactForm;

$model = new ContactForm();
?>
<ul class="nav nav-tabs nav-stacked col-md-2 ">
    <li class="active"><a href="#tab_a" data-toggle="tab">Pill A</a></li>
    <li><a href="#tab_b" data-toggle="tab">Pill B</a></li>
    <li><a href="#tab_c" data-toggle="tab">Pill C</a></li>
    <li><a href="#tab_d" data-toggle="tab">Pill D</a></li>
</ul>
<div class="tab-content col-md-10">
    <div class="tab-pane active" id="tab_a">
        <?=
        $this->render('contact', [
            'model' => $model,
        ]);
        ?>
    </div>
    <div class="tab-pane" id="tab_b">
        <?=
        $this->render('contact', [
            'model' => $model,
        ]);
        ?>
    </div>
    <div class="tab-pane" id="tab_c">
        <h4>Pane C</h4>
        <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames
            ac turpis egestas.</p>
    </div>
    <div class="tab-pane" id="tab_d">
        <?=
        $this->render('contact', [
            'model' => $model,
        ]);
        ?>
    </div>
</div><!-- tab content -->
