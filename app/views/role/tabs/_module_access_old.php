<?php 

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$cActions = Yii::$app->Role->controller_actions(); //all actions per controller
$array_access = $model->module_access_decode;

$last_role_level = ($model->isNewRecord) ? $model::lastRoleLevel() + 1 : 1;

$_script = <<<SCRIPT

$('#check-all-roles').on("click", function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
})

$('input:checkbox.role-actions').change(function(){
	if(this.checked == false){
		$('#check-all-roles').prop('checked', this.checked);

		$(this).closest('tr').find('.check-all-module-roles').prop('checked', this.checked);

	}else{
		if($('input:checkbox.role-actions:checked').length == $('input:checkbox.role-actions').length){
			$('#check-all-roles').prop('checked', this.checked);
		}

		if($(this).closest('tr').find('.role-actions:checked').length == $(this).closest('tr').find('.role-actions').length){
			$(this).closest('tr').find('.check-all-module-roles').prop('checked', this.checked);
		}
	}
})

if($('input:checkbox.role-actions').length > 0){
	if($('input:checkbox.role-actions:checked').length == $('input:checkbox.role-actions').length){
		$('#check-all-roles').prop('checked', "true");
	}
}


$('.check-all-module-roles').on("click", function(){
    $(this).closest('tr').find('input:checkbox.role-actions').prop('checked', this.checked);

    if($('input:checkbox.role-actions:checked').length == $('input:checkbox.role-actions').length){

    	$('#check-all-roles').prop('checked', true);
	}else{

    	$('#check-all-roles').prop('checked', false);
	}
})



$.each($('.check-all-module-roles'), function(index, key){
	var checkedActions = $(this).closest('tr').find('input:checkbox.role-actions:checked').length;
	var actions = $(this).closest('tr').find('input:checkbox.role-actions').length;

	if(checkedActions == actions){
		$(this).prop('checked', true)
	}else{
		$(this).removeAttr('checked')
	}
})



SCRIPT;

$this->registerJs($_script);

$_style = <<<CSS

table.table-roles td, table td * {
    vertical-align: top;
}

CSS;

$this->registerCss($_style);

$default_actions = ['create', 'index', 'update', 'delete', 'view'];
$can_actions = ['bulk-action', 'can-bulk-activate', 'can-bulk-delete', 'can-update-inactive', 'can-view-deleted', 'can-view-inactive', 'can-update-deleted', 'change-record-status'];
$export_actions = ['export-csv', 'export-excel', 'export-pdf'];

?>

	

	<?php //$form = ActiveForm::begin(); ?>
	
		<div class="row">
			<div class="col-lg-4">
				<?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Role Name') ?>
			</div>
			<div class="col-lg-4">
				<?= $form->field($model, 'level')->textInput(['type' => 'number',  'min' => $last_role_level, 'maxlength' => true])->label('Role Level') ?>
			</div>
			<div class="col-lg-4">
			</div>
		</div>

		<div class="row mb-5">
			<div class="col-lg-12">
				
	    		
	    		
			</div>
		</div>


		<table class="table table-bordered table-roles">
			<thead>
				<tr>
					<th>Controller</th>
					<th colspan="4">
						<!-- Actions -->
						<div class="checkbox-list">
							<label class="checkbox">
						        <input class="checkbox" type="checkbox" id='check-all-roles'>
						        <span></span>
						        All Actions
						    </label>
			    		</div>
					</th>
				</tr>
			</thead>
			<tbody>
				<?php if($cActions){ ?>
					<?php foreach($cActions as $controller => $module_access){ ?>
						<tr>
							<td class="font-weight-bolder">
								<div class="checkbox-list">
									<label class="checkbox">
								        <input class="checkbox check-all-module-roles" type="checkbox">
								        <span></span>
								        <?= strtoupper(str_replace('-', ' ', $controller)) ?>
								    </label>
					    		</div>
					    	</td>
							<td>
								<?php if($module_access){ ?>

									<div class="checkbox-list">
										<?php foreach($module_access as $module_access_key => $action){ ?>

											<?php if(in_array($action, $default_actions) && !in_array($action, $can_actions) && !in_array($action, $export_actions)) {?>
												<label class="checkbox">
											        <input value="<?= $action ?>" name="Role[module_access][<?= $controller ?>][]" class="checkbox role-actions" type="checkbox" <?= isset($array_access[$controller]) && in_array($action, $array_access[$controller]) ? "checked": ""?>>
											        <span></span>
											        <?= $action ?>
											    </label>
											<?php } ?>

										<?php } ?>
									</div>

								<?php } ?>
							</td>
							<td>
								<?php if($module_access){ ?>

									<div class="checkbox-list">
										<?php foreach($module_access as $module_access_key => $action){ ?>

											<?php if(!in_array($action, $default_actions) && in_array($action, $can_actions) && !in_array($action, $export_actions)) {?>
												<label class="checkbox">
											        <input value="<?= $action ?>" name="Role[module_access][<?= $controller ?>][]" class="checkbox role-actions" type="checkbox" <?= isset($array_access[$controller]) && in_array($action, $array_access[$controller]) ? "checked": ""?>>
											        <span></span>
											        <?= $action ?>
											    </label>
											<?php } ?>

										<?php } ?>
									</div>

								<?php } ?>
							</td>
							<td>
								<?php if($module_access){ ?>

									<div class="checkbox-list">
										<?php foreach($module_access as $module_access_key => $action){ ?>

											<?php if(!in_array($action, $default_actions) && !in_array($action, $can_actions) && in_array($action, $export_actions)) {?>
												<label class="checkbox">
											        <input value="<?= $action ?>" name="Role[module_access][<?= $controller ?>][]" class="checkbox role-actions" type="checkbox" <?= isset($array_access[$controller]) && in_array($action, $array_access[$controller]) ? "checked": ""?>>
											        <span></span>
											        <?= $action ?>
											    </label>
											<?php } ?>

										<?php } ?>
									</div>

								<?php } ?>
							</td>
							<td>
								<?php if($module_access){ ?>

									<div class="checkbox-list">
										<?php foreach($module_access as $module_access_key => $action){ ?>

											<?php if(!in_array($action, $default_actions) && !in_array($action, $can_actions) && !in_array($action, $export_actions)) {?>
												<label class="checkbox">
											        <input value="<?= $action ?>" name="Role[module_access][<?= $controller ?>][]" class="checkbox role-actions" type="checkbox" <?= isset($array_access[$controller]) && in_array($action, $array_access[$controller]) ? "checked": ""?>>
											        <span></span>
											        <?= $action ?>
											    </label>
											<?php } ?>

										<?php } ?>
									</div>

								<?php } ?>
							</td>
						</tr>
					<?php } ?>
				<?php } ?>
			</tbody>
		</table>


	<?php //ActiveForm::end(); ?>