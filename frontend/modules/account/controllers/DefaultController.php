<?php

namespace frontend\modules\account\controllers;

use Yii;
use yii\web\Controller;
use common\models\CarQuery;
use common\models\User;
use common\models\UserProfile;
use frontend\modules\account\models\UserSetting;
use frontend\modules\account\models\ChangePasswordForm;

class DefaultController extends Controller {

    public function actionIndex() {
        $this->redirect('/account/car');
    }

    public function actionSettings() {
        $user = \yii::$app->user->identity;
        $userSetting = new UserSetting();
        if ($user->profile->client_type == UserProfile::CLIENT_TYPE_LEG) {
            $userSetting->type = UserProfile::CLIENT_TYPE_LEG;
            $userSetting->scenario = 'company';
        }
        $userSetting->companyName = $user->profile->company_name;
        $userSetting->fio = $user->profile->fio;
        $userSetting->mobilePhone = $user->profile->mobile_phone;
        $userSetting->workPhone = $user->profile->work_phone;
        $userSetting->email = $user->email;
        return $this->render('settings', [
                'model' => $userSetting
        ]);
    }

    public function actionProfileUpdate() {
        $user = User::findOne(\yii::$app->user->identity->id);
        $userProfile = UserProfile::findOne($user->profile->id);
        $model = new UserSetting();
        if ($user->profile->client_type == UserProfile::CLIENT_TYPE_LEG) {
            $model->scenario = 'company';
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($user->profile->client_type == UserProfile::CLIENT_TYPE_LEG) {
                $userProfile->company_name = $model->companyName;
                $userProfile->work_phone = $model->workPhone;
            }
            $userProfile->fio = $model->fio;
            $userProfile->mobile_phone = $model->mobilePhone;
            if (!$userProfile->save()) {
                \Yii::$app->response->format = 'json';
                return $userProfile->errors;
            }
            return $this->redirect(['settings', 'model' => $model]);
        } else {
            \Yii::$app->response->format = 'json';
            return $model->errors;
        }
    }

    public function actionUpdateSettings() {
        $user = \yii::$app->user->identity;
        $model = new UserSetting();
        if ($user->profile->client_type == UserProfile::CLIENT_TYPE_LEG) {
            $model->type = UserProfile::CLIENT_TYPE_LEG;
            $model->scenario = 'company';
        }
        $model->companyName = $user->profile->company_name;
        $model->fio = $user->profile->fio;
        $model->mobilePhone = $user->profile->mobile_phone;
        $model->workPhone = $user->profile->work_phone;
        $model->email = $user->email;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $userProfile = UserProfile::findOne($user->profile->id);
            if ($user->profile->client_type == UserProfile::CLIENT_TYPE_LEG) {
                $userProfile->company_name = $model->companyName;
                $userProfile->work_phone = $model->workPhone;
            }
            $userProfile->fio = $model->fio;
            $userProfile->mobile_phone = $model->mobilePhone;
            $userProfile->save();
            Yii::$app->response->format = 'json';
            return [
                'message' => Yii::t('app', 'Changes successfully saved'),
            ];
        }

        return $this->renderAjax('_userSettingForm', [
                'model' => $model,
        ]);
    }

    public function actionUpdatePassword() {
        $model = new ChangePasswordForm();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->response->format = 'json';
            return [
                'message' => Yii::t('app', 'Changes successfully saved'),
            ];
        }
        return $this->renderAjax('_userSettnigForm', [
                'model' => $model
        ]);
    }

    public function actionRefillBalance() {
        return $this->render('refillBalance');
    }

}
