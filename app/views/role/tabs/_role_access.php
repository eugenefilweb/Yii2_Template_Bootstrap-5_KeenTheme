<?php 

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Role;


$roleAccess = ($model->id) ? Yii::$app->Role->getRoleAccess($model->id) : $model->role_access;
$roles = Role::find()
            ->orFilterWhere([
            	'not', [
            		'id' => [$model->id, 1] //exclude self and super admin
            	]
            ])
            ->all();

?>


		<div class="row mb-5">
			<div class="col-lg-12 mb-5">
				<h5>Can Manage Users</h5>
			</div>
			<div class="col-lg-12">
				
				<?php if($roles){ ?>

					<div class="checkbox-list">
						<?php foreach($roles as $role_access_key => $action){ ?>

							<label class="checkbox">
						        <input value="<?= $action->id ?>" name="Role[role_access][]" class="checkbox" type="checkbox" <?= (!empty($roleAccess)) ? (in_array($action->id, $roleAccess) ? 'checked' : '') : null ?>>
						        <span></span>
						        <?= $action->name ?>
						    </label>

						<?php } ?>
					</div>

				<?php } ?>
	    		
			</div>
		</div>

