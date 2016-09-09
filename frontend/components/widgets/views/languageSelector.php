<?php

use yii\helpers\Html;
?>

<?php echo Html::beginForm() ?>
<div id="language-selector">
    <?php
    if (sizeof($languages) < 2) {
        $lastElement = end($languages);
        foreach ($languages as $key => $lang) {
            if ($key != $currentLang) {
                echo Html::ajaxLink($lang, '', [
                    'type' => 'post',
                    'data' => '_lang=' . $key . '&YII_CSRF_TOKEN=' . \Yii::$app->request->csrfToken,
                    'success' => 'function(data) { window.location.reload();}'
                    ], []);
            }
        }
    } else {
        echo Html::dropDownList('_lang', $currentLang, $languages, [
            'onchange' => 'language_change(this)',
            'csrf' => true,
        ]);
    }
    ?>
    <script type="text/javascript">
        function language_change(selected) {
            $.ajax('<?= \yii\helpers\Url::to(['/site/change-lang']) ?>', {
                'type': 'post',
                'data': '_lang=' + selected + '&YII_CSRF_TOKEN='<?= \Yii::$app->request->csrfToken ?>',
                        success: function (data) {
                            window.location.reload();
                        }
            });
        }
    </script>
</div>

<?php echo Html::endForm(); ?>