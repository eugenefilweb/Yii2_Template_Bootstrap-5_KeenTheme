<?php 

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;

abstract class CustomController extends \yii\web\Controller
{
    public function behaviors()
    {
        $moduleAccess = Yii::$app->Role->getModuleAccess();

        return [
            'AccessControl' => [
                'class' => AccessControl::class, 
                'only' => Yii::$app->Role->getActions(),
                'rules' => [
                    [
                        'actions' => $moduleAccess,
                        'allow' => (!empty($moduleAccess)) ? true : false,
                        'roles' => ['@'],
                    ],  
                ],
            ],
        ];
    } 

    public function beforeAction($action) 
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
  
        return true;
    }

    public function jsonResponse()
    {
        return Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    }

    public function htmlResponse()
    {
        return Yii::$app->response->format = \yii\web\Response::FORMAT_HTML;
    }
}


?>