<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Role $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="role-view">

    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title"><?= Html::encode($this->title) ?></div>
            <div class="card-toolbar">

                <div class="dropdown mr-2">
                    <?= Html::a('Reset Navigation', ['#'], ['class' => 'btn btn-sm btn-outline-warning dropdown-toggle', 'data-toggle' => 'dropdown']) ?>
                    <div class="dropdown-menu">
                        <?php foreach(Yii::$app->params['roles'] as $role_key => $role_value){ ?>
                            <?= Html::a("As {$role_value['label']}", ['role/reset-navigation', 'id' => $model->id, 'role' => $role_key], ['class' => 'dropdown-item']) ?>
                        <?php } ?>
                    </div>
                </div>
                <div class="dropdown mr-2">
                    <?= Html::a('Reset All Module Access', ['#'], ['class' => 'btn btn-sm btn-outline-warning dropdown-toggle', 'data-toggle' => 'dropdown']) ?>
                    <div class="dropdown-menu">
                        <?php foreach(Yii::$app->params['roles'] as $role_key => $role_value){ ?>
                            <?= Html::a("As {$role_value['label']}", ['role/reset-module-access', 'id' => $model->id, 'role' => $role_key], ['class' => 'dropdown-item']) ?>
                        <?php } ?>
                    </div>
                </div>

                <?= Html::a('Reset Navigation', ['reset-navigation', 'id' => $model->id, 'role' => ''], ['class' => 'btn btn-primary btn-sm mr-2']) ?>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm mr-2']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger btn-sm',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
        <div class="card-body">
                    
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    'module_access:ntext',
                    'role_access:ntext',
                    'navigations:ntext',
                    'level',
                    'record_status',
                    'created_at',
                    'updated_at',
                    'created_by',
                    'updated_by',
                ],
            ]) ?>

        </div>
    </div> 

</div>
