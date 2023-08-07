<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\UserSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title"><?= Html::encode($this->title) ?></div>
            <div class="card-toolbar"><?= Html::a('Create User', ['create'], ['class' => 'btn btn-success btn-sm']) ?></div>
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
                        'role_id',
                        'username',
                        'email:email',
                        'password_hash',
                        //'password_reset_token',
                        //'verification_token',
                        //'auth_key',
                        //'access_token',
                        //'status',
                        //'record_status',
                        //'is_blocked',
                        //'created_at',
                        //'updated_at',
                        //'created_by',
                        //'updated_by',
                        [
                            'class' => ActionColumn::class,
                            'urlCreator' => function ($action, User $model, $key, $index, $column) {
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
