<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
// use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\forms\LoginForm;
use app\models\forms\ContactForm;
use app\models\forms\PasswordResetRequestForm;
use app\models\forms\ResetPasswordForm;
use yii\helpers\Html;
use yii\web\BadRequestHttpException;
use yii\base\InvalidArgumentException;
use app\controllers\CustomController;

class SiteController extends CustomController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // guest actions
        $behaviors['AccessControl']['rules'][] = Yii::$app->Navigation->setGuestActions([
            'index', 
            'login', 
            'forgot-password', 
            'reset-password'
        ]);

        $behaviors['VerbsFilter'] = [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ];

        return $behaviors;
    }
    
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'main_error'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {

            return $this->render('index');
        }

        return $this->redirect(['login']);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'main_login.php';
        
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionForgotPassword()
    {
        $this->layout = 'main_login.php';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {

                if ($model->sendEmail()) {
                    return json_encode([
                        'color' => 'green',
                        'message' => 'Check your email for further instructions.'
                    ]);
                    // Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                } else {
                    return json_encode([
                        'color' => 'red',
                        'message' => 'Sorry, we are unable to reset password for the provided email address.'
                    ]);
                    // Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
                }

            }

            return json_encode([
                'color' => 'yellow',
                'message' => Html::errorSummary($model)
                // 'message' => $model->errors['email'][0]
            ]);

        }

        return $this->render('password_reset', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        $this->layout = 'main_login.php';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {

                if ($model->resetPassword()) {
                    return $this->goHome();
                }

            }

        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
