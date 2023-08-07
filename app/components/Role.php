<?php

namespace app\components;
 
use Yii;
use yii\base\Component; 
use yii\helpers\FileHelper;
use yii\helpers\Inflector;
use app\models\Role as Roles;

class Role extends Component
{

    public function controller_actions($exclude=[])
    {
        // get controllers' path
        $controller_paths = FileHelper::findFiles(Yii::getAlias('@app/controllers'),[
            'recursive' => true
        ]);

        // convert controllers' path to controllers' names
        foreach($controller_paths as $controller_path){ 

            $content = file_get_contents($controller_path); //gets the controllers' contents 
            $controller_name = Inflector::camel2Id(substr(basename($controller_path), 0, -14));

            if (isset($exclude['controllers_excluded']) && !empty($exclude['controllers_excluded'])) {
                // whole controller exclude
                if(in_array($controller_name, $exclude['controllers_excluded']) && empty($exclude['controllers_excluded'][$controller_name])) { continue; }
            }

            preg_match_all('/public function action(\w+?)\(/', $content, $result);

            sort($result[1]);
        
            foreach($result[1] as $action){
                $action_name = Inflector::camel2Id($action); 

                if($action_name == 's'){
                    continue;
                } 

                if (!empty($exclude['controllers_excluded'][$controller_name])) {
                    // exclude controller with specific action
                    if (in_array($action_name, $exclude['controllers_excluded'][$controller_name])) { continue; }
                }

                if (isset($exclude['actions_excluded']) && !empty($exclude['actions_excluded'])) {
                    // actions excluded
                    if (in_array($action_name, $exclude['actions_excluded'])) { continue; }
                }

                $controller_actions[$controller_name][] = $action_name; 
                
            } 
        }   

        asort($controller_actions); //sort by key

        return $controller_actions;
    }

    public function getActions($controller = null)
    { 
        $controller = ($controller) ?: Yii::$app->controller->id;
        // get all actions per Controller
        return $this->controller_actions()[$controller];
    }

    public function getModuleAccess($controller = null)
    {   
        $controller = $controller ?: Yii::$app->controller->id;

        if(!Yii::$app->user->isGuest){ 
            $role = Yii::$app->user->identity->role;
            // all user accessed actions
            $userAccess = json_decode($role->module_access, true); 
            // $userAccess = $role->module_access; 

            // filter user access based on controller visited
            $access = isset($userAccess[$controller]) ? json_decode($role->module_access, true)[$controller] : null;  
            // $access = isset($userAccess[$controller]) ? $role->module_access[$controller] : null;  

        } else{ 
            return false;
        }
         
        return ($access != []) ? $access : []; 
    }

    public function getRoleAccess($role_id = null)
    {
        if (!$role_id) {
            return null;
        }

        $model = Roles::find()
            ->orFilterWhere(['id' => $role_id])
            ->one();

        return json_decode($model->role_access, true);
    }

    public function getAllControllerWithActions($controller = null)
    {
        $data = [];
        if (!empty($this->controller_actions())) {

            foreach ($this->controller_actions() as $controller => $actions) {

                if(!empty($actions)){
                    foreach ($actions as $key => $action) {
                        $data[] = $controller.'/'.$action;
                    }
                }

            }

        }

        return $data;
    }
 
} 

?>