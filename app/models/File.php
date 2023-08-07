<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%file}}".
 *
 * @property int $id
 * @property string $token
 * @property string $name
 * @property string $location
 * @property int $size
 * @property string $extension
 * @property int $record_status
 * @property string $created_at
 * @property string $updated_at
 */
class File extends ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%file}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['token', 'name', 'location', 'size', 'extension'], 'safe'],
            [['token', 'location'], 'string'],
            [['size', 'record_status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'extension'], 'string', 'max' => 256],
            [['file'], 'file', 'skipOnEmpty' => true],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'token' => 'Token',
            'name' => 'Name',
            'location' => 'Location',
            'size' => 'Size',
            'extension' => 'Extension',
            'record_status' => 'Record Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    public function getFile_display($params = null, $lazy = true)
    {
        $params = ($params) ?: $this;

        $actions = ['export-csv', 'export-excel'];

        if (!in_array(Yii::$app->controller->action->id, $actions)) {

            $dataLazy = (Yii::$app->controller->action->id == 'export-pdf') ? null : ($lazy ? "data-" : null);

            switch ($params->extension) {
                case 'docx':
                    return '<div class="" style="max-width: 120px; max-height: auto;">
                                <img class="img-fluid '.($lazy ? "img-lazy" : null).'" '.$dataLazy.'src="'.Url::to(['file/display','token'=>$params->token, 'h'=>50,'w'=>50, 'q'=>90], true).'">
                            </div>';
                    break;
                
                case 'doc':
                    return '<div class="" style="max-width: 120px; max-height: auto;">
                                <img class="img-fluid '.($lazy ? "img-lazy" : null).'" '.$dataLazy.'src="'.Url::to(['file/display','token'=>$params->token, 'h'=>50,'w'=>50, 'q'=>90], true).'">
                            </div>';
                    break;
                
                case 'pdf':
                    return '<div class="" style="max-width: 120px; max-height: auto;">
                                <img class="img-fluid '.($lazy ? "img-lazy" : null).'" '.$dataLazy.'src="'.Url::to(['file/display','token'=>$params->token, 'h'=>50,'w'=>50, 'q'=>90], true).'">
                            </div>';
                    break;
                                
                case 'svg':
                    return '<div class="" style="max-width: 120px; max-height: auto;">
                                <img class="img-fluid '.($lazy ? "img-lazy" : null).'" '.$dataLazy.'src="'.Url::to(['file/display','token'=>$params->token, 'h'=>50,'w'=>50, 'q'=>90], true).'">
                            </div>';
                    break;
                                
                case 'xls':
                    return '<div class="" style="max-width: 120px; max-height: auto;">
                                <img class="img-fluid '.($lazy ? "img-lazy" : null).'" '.$dataLazy.'src="'.Url::to(['file/display','token'=>$params->token, 'h'=>50,'w'=>50, 'q'=>90], true).'">
                            </div>';
                    break;
                                
                case 'xlsx':
                    return '<div class="" style="max-width: 120px; max-height: auto;">
                                <img class="img-fluid '.($lazy ? "img-lazy" : null).'" '.$dataLazy.'src="'.Url::to(['file/display','token'=>$params->token, 'h'=>50,'w'=>50, 'q'=>90], true).'">
                            </div>';
                    break;

                case 'png':
                    return '<div class="" style="max-width: 120px; max-height: auto;">
                                <img class="img-fluid img-thumbnail '.($lazy ? "img-lazy" : null).'" '.$dataLazy.'src="'.Url::to(['file/display','token'=>$params->token, 'h'=>50,'w'=>50, 'q'=>90], true).'">
                            </div>';
                    break;

                case 'jpeg':
                    return '<div class="" style="max-width: 120px; max-height: auto;">
                                <img class="img-fluid img-thumbnail '.($lazy ? "img-lazy" : null).'" '.$dataLazy.'src="'.Url::to(['file/display','token'=>$params->token, 'h'=>50,'w'=>50, 'q'=>90], true).'">
                            </div>';
                    break;

                case 'jpg':
                    return '<div class="" style="max-width: 120px; max-height: auto;">
                                <img class="img-fluid img-thumbnail '.($lazy ? "img-lazy" : null).'" '.$dataLazy.'src="'.Url::to(['file/display','token'=>$params->token, 'h'=>50,'w'=>50, 'q'=>90], true).'">
                            </div>';
                    break;
                
                default:
                    return '<i class="la la-file-code icon-4x"></i>';
                    break;
            }

        }

        return $params->extension;
    }

    public function filedirectory($folder_slug)
    { 
        $root_dir = Yii::getAlias('@webroot').'/uploads/'.$folder_slug;
        $archiveFolder = date("Y")."/".date("m")."/";   
        $directory = $root_dir.'/'.$archiveFolder;

        //create folder if does not exist 
        (!is_dir($directory)) ? mkdir($directory, 0777, true) : null;
 
        return $directory;
    }
 
    public function upload($file, $folder_slug)
    {           
        if($this->validate()){   

            if ($file) {
                $file_name = $this->checkDuplicateName($file->baseName, $file->extension, $this->filedirectory($folder_slug));
                return $file->saveAs($file_name['file'], false) ? $file_name['file_name'] : false;
            }
            
        }else{
            var_dump($this->errors);
            die;
        }

        return false;
        
    }

    public function checkDuplicateName($file_name, $ext, $file_path, $recurse_count=null)
    {
        $file = $file_path.$file_name.".{$ext}";

        if (file_exists($file)) {

            if (strpos($file_name, ' (') !== false && strpos($file_name, ')') !== false) {
                
                $start = strpos($file_name, '(') + 1;
                $end = strpos($file_name, ')') - $start;

                $file_count = substr($file_name, $start, $end);

                if (is_numeric($file_count)) {
                    $new_recurse_count = $file_count + 1;
                    $file_name = substr_replace($file_name, $new_recurse_count, $start, $end); //replace file duplicate count
                    return $this->checkDuplicateName($file_name, $ext, $file_path, $new_recurse_count);
                }else{
                    $new_recurse_count = $recurse_count + 1;
                    $file_name = substr_replace($file_name, $new_recurse_count, $start, $end);
                    return $this->checkDuplicateName($file_name." ({$recurse_count})", $ext, $file_path, $recurse_count);
                }

            }else{

                $recurse_count = $recurse_count == null ? 1 : $recurse_count + 1;
                return $this->checkDuplicateName($file_name." ({$recurse_count})", $ext, $file_path, $recurse_count);

            }

        }else{
            return [
                'file' => $file,
                'file_name' => $file_name.".{$ext}",
            ];
        }

    }
}
