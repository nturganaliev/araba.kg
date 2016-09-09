<?php

namespace frontend\components;

class LanguageHandler extends \yii\base\Behavior {

    public function events() {
        return [\yii\web\Application::EVENT_BEFORE_REQUEST => 'handleBeginRequest'];
    }

    public function handleBeginRequest($event) {
        if (\Yii::$app->user->isGuest) {
            $cookies = \Yii::$app->request->cookies;
            if ($cookies->has('language')) {
                \Yii::$app->language = $cookies['language']->value;
            }
        } else {
            $profile = \common\models\UserProfile::find()
                    ->where(['id' => \Yii::$app->user->id])->one();
            if ($profile != NULL) {
//                var_dump($profile->lang);die();
                \Yii::$app->language = $profile->lang;
            }
        }
    }

}
