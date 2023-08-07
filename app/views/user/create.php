<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['search'] = $model;
?>

<div class="user-create">
	
	<div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title"><?= Html::encode($this->title) ?></div>
            <div class="card-toolbar"></div>
        </div>
        <div class="card-body">
					
			<?= $this->render('_form', [
				'model' => $model,
			])?>

        </div>
    </div>


</div>
