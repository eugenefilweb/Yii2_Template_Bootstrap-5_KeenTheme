<?php

namespace app\components; 
 
use Yii;
use yii\base\Component;  
use yii\helpers\Html;
use yii\helpers\Url;
 
class Navigation extends Component
{   
    public function setGuestActions($params = null)
    {
        if (!empty($params)) {
            return [
                'actions' => is_array($params) ? $params : [$params],
                'allow'   => true,
                'roles'   => ['?'],
            ];

        }

        return [];
    }

    public function checkActiveNavigation($url, $position = null)
    {
        if ($position == 'exact') {
                    // exact
            if(Yii::$app->controller->id.'/'.Yii::$app->controller->action->id == $url){
                return true;
            }

        }else{

            // contains
            if(strpos($url, Yii::$app->controller->id) !== false){
                return true;
            }

        }


        return false;
    }

    public function generateNavigationMenu($array_list)
    {

        $menu = '';
        if (is_array($array_list)) {
            
            foreach ($array_list as $key => $properties) {

                $menu .= "<li class='dd-item' data-logo='".$properties['icon']."' data-label='".$properties['label']."' data-url='".$properties['url']."' data-new_tab='".$properties['new_tab']."'>";

                $menu .= "<div class='dd-handle dd3-handle'>
                            <i class='fas fa-th'></i>
                        </div>";

                $menu .= "<div class='dd3-content'>  
                            <div class='row'>
                                <div class='col'>
                                    <input type='text' class='form-control' data-action='label' value='".$properties['label']."' required/>
                                </div>
                                <div class='col'>
                                    <input type='text' class='form-control' data-action='logo' value='".$properties['icon']."' required/>
                                </div>
                                <div class='col'>
                                    <input type='text' list='urls' class='form-control' data-action='url' value='".$properties['url']."' ".(is_array($properties['actions']) && !empty($properties['actions']) ? '' : 'required')."/>
                                </div>
                                <div class='col'>
                                    <label class='checkbox checkbox-outline checkbox-outline-2x checkbox-primary'>
                                        <input type='checkbox' data-action='new_tab' value='1' ".($properties['new_tab'] ? 'checked' : '')."/>
                                        <span class='mr-2'></span>
                                        New tab
                                    </label>
                                </div>

                                <div class='col text-right'>
                                    <span class='remove-nav' style='cursor:pointer;'><i class='far fa-times-circle text-danger'></i></span>
                                </div>
                            </div>
                         </div>"; 

                    // has child
                   if(is_array($properties['actions']) && !empty($properties['actions'])){ 
                        $menu .= "<ol class='dd-list'>"; 
                            $menu .= $this->generateNavigationMenu($properties['actions']); 
                        $menu .= "</ol>"; 
                   }
     
                $menu .= "</li>"; 
            }   

        }
        return $menu; 
    }

    public function generateNavigationsFromNestable($params = ['navigations' => null, 'icon' => null, 'label' => null, 'parent_link' => null])
    {       
        $decoded_navs = is_array($params['navigations']) ? $params['navigations'] : json_decode($params['navigations'], true);
        $navigations = ($decoded_navs) ? $decoded_navs : [];  

        $navs = array();
          
        foreach ($navigations as $key => $attributes) {

            if($attributes['label'] == '' || $attributes['label'] == null){
                continue;
            }

            $new_key = strtolower(str_replace(' ', '-', $attributes['label']));

            $navs[$new_key] = [
                    'icon' => isset($attributes['logo']) ? $attributes['logo'] : '<i class="fas fa-bars"></i>',
                    'label' => isset($attributes['label']) ? $attributes['label'] : 'Not Set',
                    'url' => isset($attributes['url']) ? $attributes['url'] : '#',
                    'new_tab' => (isset($attributes['new_tab']) && $attributes['new_tab'] == 1) ? 1 : '',
                    'actions' => (isset($attributes['children']) && is_array($attributes['children']) && !empty($attributes['children'])) ? $this->generateNavigationsFromNestable(['navigations' => $attributes['children']]) : [],
            ]; 

        }      
         
        return $navs;
    }


}