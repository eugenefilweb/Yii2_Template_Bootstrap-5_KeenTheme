<?php 

namespace app\widgets;

use Yii;
use yii\base\Widget;

class Subheader extends Widget 
{
    public $actions;

    public function init() 
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('sub-header', [
            'actions' => $this->actions
        ]);
    }
}


?>