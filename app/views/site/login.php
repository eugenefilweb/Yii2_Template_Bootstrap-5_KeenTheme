<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\forms\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;

?>

    
<!--begin::Signin-->
<div class="login-form login-signin">

	<!--begin::Form-->
    <?php $form = ActiveForm::begin([
            'id' => 'kt_login_signin_form',  
            'options' => [
                'class' => 'form',
                'novalidate' => 'novalidate'
            ]
        ]); ?>

		<!--begin::Title-->
		<div class="pb-13 pt-lg-0 pt-5">
			<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Welcome to <?= Yii::$app->name ?></h3>
			<!-- <span class="text-muted font-weight-bold font-size-h4">New Here? -->
			<!-- <a href="<?php //echo Url::to(['user/signup']) ?>" class="text-primary font-weight-bolder">Create an Account</a></span> -->
		</div>
		<!--begin::Title-->
		<!--begin::Form group-->
        <?= $form->field($model, 'username', [
        	'template' => '<div class="form-group">
	        					{label}
								{input}
							</div>
							{error}
							{hint}',
			'labelOptions' => ['class' => 'font-size-h6 font-weight-bolder text-dark']
			])->textInput(['class' => 'u form-control form-control-solid h-auto p-6 rounded-lg'])->label('Email or Username') ?>
		<!--end::Form group-->

		<!--begin::Form group-->
		<?= $form->field($model, 'password', [
        	'template' => '<div class="form-group">
								<div class="d-flex justify-content-between mt-n5">
									{label}
									<a href="'.Url::to(['user/recovery-password']).'" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" >Forgot Password ?</a>
								</div>
								{input}
							</div>
							{error}
							{hint}',
			'labelOptions' => ['class' => 'font-size-h6 font-weight-bolder text-dark pt-5']
			])->passwordInput(['class' => 'u form-control form-control-solid h-auto p-6 rounded-lg'])->label('Password') ?>
		<!--end::Form group-->

		<!--begin::Action-->
		<div class="pb-lg-0 pb-5">
			<button type="submit" id="kt_login_signin_submit" class="btn btn-sm btn-primary font-weight-bolder px-8 py-4 my-3 mr-3">Sign In</button>
		</div>

		<!--end::Action-->
	<!-- </form> -->

    <?php ActiveForm::end(); ?>
	<!--end::Form-->
</div>
<!--end::Signin-->