<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\File $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Files', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="file-view">

    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title"><?= Html::encode($this->title) ?></div>
            <div class="card-toolbar">
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
                    'location:ntext',
                    'extension',
                    'size',
                    'token',
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
