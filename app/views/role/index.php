<?php

use app\models\Role;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\RoleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-index">
    
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title"><?= Html::encode($this->title) ?></div>
            <div class="card-toolbar"><?= Html::a('Create Role', ['create'], ['class' => 'btn btn-success btn-sm']) ?></div>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'tableOptions' => ['class' => 'table'],
                    'options' => ['style' => 'min-height:50vh'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'id',
                        'name',
                        'module_access:ntext',
                        'role_access:ntext',
                        'navigations:ntext',
                        //'level',
                        //'record_status',
                        //'created_at',
                        //'updated_at',
                        //'created_by',
                        //'updated_by',
                        [
                            'class' => ActionColumn::class,
                            'urlCreator' => function ($action, Role $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'id' => $model->id]);
                            }
                        ],
                    ],
                ]); ?>
            </div>

        </div>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

</div>
