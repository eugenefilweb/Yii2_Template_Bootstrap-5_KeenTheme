<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Role $model */

$this->title = 'Create Role';
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
