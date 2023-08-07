<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\File $model */

$this->title = 'Create File';
$this->params['breadcrumbs'][] = ['label' => 'Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-create">

    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title"><?= Html::encode($this->title) ?></div>
            <div class="card-toolbar"></div>
        </div>
        <div class="card-body">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        
        </div>
    </div>

</div>
