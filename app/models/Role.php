<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%role}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $module_access
 * @property string|null $role_access
 * @property string|null $navigations
 * @property int $level
 * @property string $date_created
 * @property string $date_updated
 */
class Role extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%role}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'level'], 'required'],
            [['module_access', 'role_access', 'navigations'], 'safe'],
            [['level'], 'integer'],
            [['date_created', 'date_updated'], 'safe'],
            [['name'], 'string', 'max' => 256],
            [['role_access'], 'default', 'value'=>'[]'],
            [['module_access'], 'default', 'value'=>'[]'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'module_access' => 'Module Access',
            'role_access' => 'Role Access',
            'navigations' => 'Navigations',
            'level' => 'Level',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }

    public function getModule_access_decode()
    {
        return json_decode($this->module_access, true);
    }


    public function getRole_access_decode()
    {
        return json_decode($this->role_access, true);
    }

    public static function lastRoleLevel()
    {
        return Role::find()
        ->orderBy(['level' => SORT_DESC])
        // ->limit(1)
        ->one()->level;
    }

    public function getNavigation_decode()
    {
        return json_decode($this->navigations, true);
    }

    public function getUsers()
    {
        return $this->hasMany(User::class, ['role_id' => 'id']);
    }

    public function getUsersCount()
    {
        return count($this->users);
    }

    public function getModuleAccess()
    {
        $module_values = array_map(function($module){
            return Inflector::camel2words(Inflector::id2camel($module));
        }, array_keys(Yii::$app->user->identity->role->module_access));

        $module_keys = array_map(function($module){
            return Inflector::id2camel($module);
        }, array_keys(Yii::$app->user->identity->role->module_access));

        return array_combine($module_keys, $module_values);
    }
    
    public static function dropDown($key='id', $value= 'value', $params = [])
    {
        $models = static::find()
                    ->orFilterWhere($params)
                    ->orderBy(['id' => SORT_ASC])
                    ->all();


        $models = ArrayHelper::map($models, $key, $value);

        return $models;
    }

}
