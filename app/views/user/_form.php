<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Role;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'role_id')->dropDownlist(Role::dropDown('level', 'name'))->label('Role') ?>

    <?= $form->field($model, 'status')->dropDownlist(User::dropDownStatus()) ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'password') ?>
    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
