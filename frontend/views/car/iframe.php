<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* @var $this yii\web\View */
?>
<div class="row">
    <div class="col-sm-2">
        <button id="iframe-value" class="btn btn-default">Get!</button>
        <?php
        $this->registerJs("
            $('#iframe-value').bind('click', function() {
                var value = $('#iFrame').contents().find('#loginform-username').val();
                alert(value);
            });
        ");
        ?>
    </div>
    <div class="col-sm-10">
        <p>sksksk</p>
        <iframe id="iFrame" src="http://araba.test/foo" width="900" height="500" style="display: compact"></iframe>
        <p>f;askdfja;sdjkflajsdf
            aslkdfja;lsjdflakjsdflkjasdkfjas ;dfjas;ldkjfa sdkjf ;aslkdjf al;skdjf alskjdf ;asdjfl</p>
    </div>
</div>

