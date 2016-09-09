<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use common\models\UploadForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupFormIndividualClient;
use frontend\models\SignupFormLegalClient;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller {
//	public $layout = 'registration';

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [

            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'upload'],
                'rules' => [
                    [
                        'actions' => ['signup', 'upload', 'change-lang'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'upload'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'thumb' => 'iutbay\yii2imagecache\ThumbAction',
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

//    public function actionChangeLang() {
//        if (\Yii::$app->request->post('_lang') !== NULL && array_key_exists(\Yii::$app->request->post('_lang'), \Yii::$app->params['languages'])) {
//            $session = Yii::$app->session;
//            $session->set('language', $lang);
//            if (Yii::$app->request->referrer) {
//                return $this->redirect(Yii::$app->request->referrer);
//            } else {
//                return $this->goHome();
//            }
//        }
//        \Yii::$app->end();
//    }

    public function actionChangeLang($lang) {
        if (!\Yii::$app->user->isGuest) {
//            var_dump(1);die();
            $profile = \Yii::$app->user->identity->profile;
            $profile->lang = $lang;
            $profile->save();
        }

        Yii::$app->response->cookies->add(new \yii\web\Cookie([
            'name' => 'language',
            'value' => $lang,
            'expire' => strtotime('+1 year'),
        ]));

        if (Yii::$app->request->referrer) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->goHome();
        }
    }

    public function actionUpload() {
        $model = new UploadForm();

        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstances($model, 'file');

//            if ($model->file && $model->validate()) {
//                $model->file->saveAs('uploads/' . $model->file->baseName . '.' . $model->file->extension);
//            }
//

            if ($model->file && $model->validate()) {
                foreach ($model->file as $file) {
                    $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
                }
            }
        }

        return $this->render('uploadView', ['model' => $model]);
    }

    public function actionTest() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $result = \yii\helpers\ArrayHelper::map(\common\models\CarType::getCompleteSetsByType(\common\models\Car::CAR_TYPE_AUTOMOBILE), 'id', 'tname');
        asort($result);
        return $result;

//        return \yii\helpers\ArrayHelper::map(\common\models\CarType::getCompleteSetsByType(\common\models\Car::CAR_TYPE_AUTOMOBILE), 'id', 'tname');
    }

    public function actionIndex() {
        $this->layout = 'main_page';
        return $this->render('index');
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $profile = \Yii::$app->user->identity->profile;

            Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name' => 'language',
                'value' => $profile->lang,
                'expire' => strtotime('+1 year'),
            ]));

            return $this->redirect(['/account/car']);
//            return $this->goBack();
        } else {
            $modelLoginForm = new LoginForm();
            $modelIndividualClient = new SignupFormIndividualClient();
            $modelLegalClient = new SignupFormLegalClient();
            $type = 0;

            return $this->render('signup', [
                    'modelIndividualClient' => $modelIndividualClient,
                    'modelLegalClient' => $modelLegalClient,
                    'modelLoginForm' => $model,
                    'type' => $type
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                    'model' => $model,
            ]);
        }
    }

    public function actionAbout() {
        return $this->render('about');
    }

    public function actionSignup($type = 0) {
//		$this->layout = 'registrationMain';

        $modelLoginForm = new LoginForm();
        $modelIndividualClient = new SignupFormIndividualClient();
        $modelLegalClient = new SignupFormLegalClient();
        if ($type == 0) {
            if ($modelIndividualClient->load(Yii::$app->request->post())) {
                if ($user = $modelIndividualClient->signup()) {
                    if (Yii::$app->getUser()->login($user)) {
                        return $this->redirect(['/account/car']);
                    }
                }
            }
        } else {
            if ($modelLegalClient->load(Yii::$app->request->post())) {
                if ($user = $modelLegalClient->signup()) {
                    if (Yii::$app->getUser()->login($user)) {
                        return $this->redirect(['/account/car']); // временно, matter to change full if statement
//                        return $this->goHome();
                    }
                }
            }
        }

        return $this->render('signup', [
                'modelIndividualClient' => $modelIndividualClient,
                'modelLegalClient' => $modelLegalClient,
                'modelLoginForm' => $modelLoginForm,
                'type' => $type
        ]);
    }

    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                'model' => $model,
        ]);
    }

    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                'model' => $model,
        ]);
    }

    public function actionOffline() {
        return $this->renderPartial('offline');
    }

}
