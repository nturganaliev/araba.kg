<?php

use yii\bootstrap\Modal;
use frontend\modules\account\models\ChangePasswordForm;

$model = new ChangePasswordForm();
Modal::begin([
    'header' => '<strong>' . Yii::t('app', 'Change user password') . '</strong>',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" value="' . Yii::t('app', 'Save changes') . '" onclick="$(\'#update-user-password-form\').trigger(\'beforeSubmit\');" />',
    'toggleButton' => [
        'tag' => 'button',
        'class' => 'btn btn-info',
        'label' => \yii::t('app', 'Change password'),
    ]
]);

echo $this->render('_changePasswordForm', [
    'model' => $model,
]);

Modal::end();
?>