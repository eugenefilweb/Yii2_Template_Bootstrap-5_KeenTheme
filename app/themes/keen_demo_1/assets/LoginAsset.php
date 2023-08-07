<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\themes\keen_demo_1\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LoginAsset extends AssetBundle
{
    // public $basePath = '@webroot'; 
    public $sourcePath = '@app/themes/keen_demo_1/assets/assetsfiles';
    public $baseUrl = '@web';
    public $css = [   
        'https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700',
        'plugins/custom/prismjs/prismjs.bundle.css',
        'css/style.bundle.min.css', //'css/style.bundle.css',

        'css/pages/login/login-1.css',

    ];
    public $js = [    
        'plugins/custom/prismjs/prismjs.bundle.js',
        'js/scripts.bundle.js', 

    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset', //'yii\bootstrap\BootstrapAsset'
    ]; 

    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD,  
        // 'defer' => 'defer',
        // 'async' => 'async',
    ];
}
