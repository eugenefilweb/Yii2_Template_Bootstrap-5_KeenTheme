<?php

namespace app\controllers;

use Yii;
use app\models\File;
use app\models\search\FileSearch;
// use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Inflector;
use yii\helpers\Html;
use app\controllers\CustomController;

/**
 * FileController implements the CRUD actions for File model.
 */
class FileController extends CustomController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        // guest actions
        $behaviors['AccessControl']['rules'][] = Yii::$app->Navigation->setGuestActions([
            'display'
        ]);

        $behaviors['VerbsFilter'] = [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                ],
            ];

        return $behaviors;
    }

    public function beforeAction($action)
    {
        
        if ($action->id == 'upload') {
            $this->enableCsrfValidation = false;
        }

        if (!parent::beforeAction($action)) {
            return false;
        }

        return true;
    }

    public function actionUpload()
    {
        if ($post = Yii::$app->request->post()) {

            $model = new File();
            $model->load($post);
            $file_upload = UploadedFile::getInstance($model, 'file');

            $filename  = $model->file->baseName.".".$model->file->extension; 
            $folder =  (isset($post['meta'])) ? Inflector::camel2id($post['meta']) : 'others';

            if ($uploaded_filename = $model->upload($file_upload, $folder)) {
                $archiveFolder = "/uploads/{$folder}/".date("Y")."/".date("m")."/".$uploaded_filename;

                // save file
                $model->name = $uploaded_filename;
                $model->size = filesize($file_upload->tempName);
                $model->location = $archiveFolder;
                $model->token = Yii::$app->formatter->generateToken(24);
                $model->extension = pathinfo($uploaded_filename, PATHINFO_EXTENSION);

                if ($model->save()) {
                    return json_encode([
                        'error' => false,
                        'message' => 'File uploaded.',
                        'file_id' => $model->id,
                        'file_token' => $model->token,
                        'url' => \yii\helpers\Url::to(['file/display', 'token' => $model->token], true)
                    ]);
                }

            }
        }

        return json_encode([
            'error' => true,
            'message' => 'Invalid method.'
        ]);

    }

    /**
     * Lists all File models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FileSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDisplay($token=null, $w = 200, $q = 100, $user = false)
    {
        session_write_close();
        ignore_user_abort(false);

        $file = File::findOne(['token' => $token]);
        
        if ($file) {
            $path = Yii::getAlias('@webroot').$file->location; // platform default photo
        }else{
            $default_photo_file = ($user) ? 'avatar.png' : 'no-image.jpg';
            $path = Yii::getAlias('@webroot').'/uploads/default_photo/'.$default_photo_file; // use direct default photo
        }
        
        return $this->renderAjax('display', ['path' => $path]);
    }

    public function actionDownload($token)
    {
        $model    = $this->findModel($token);  

        if($model){
            $filepath = Yii::getAlias('@webroot').$model->location;  

            if(Yii::$app->response->sendFile($filepath, $model->name)){
                return true; 
            }else{
                return false; 
            } 
        }else{ 
            return $this->redirect(['site/error']);
        }
    }

    /**
     * Displays a single File model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($token)
    {
        return $this->render('view', [
            'model' => $this->findModel($token),
        ]);
    }

    /**
     * Creates a new File model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new File();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing File model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($token)
    {
        $model = $this->findModel($token);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing File model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($token)
    {
        if(Yii::$app->request->isAjax){

            $model = $this->findModel($token);

            $model->record_status = 0;
            
            if ($model->save()) {
                return json_encode([
                    'error' => false,
                    'message' => 'Deleted success.'
                ]);
            }

            return json_encode([
                'error' => true,
                'message' => Html::errorSummary($model)
            ]);

        }else{

            $model = $this->findModel($token);

            $model->record_status = 0;
            $model->save();
            
            // $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the File model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return File the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($token)
    {
        if (($model = File::find()->where(['token' => $token])->canAccess()->one()) !== null) {
            return $model;
        }
        if (($model = File::findOne($token)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
