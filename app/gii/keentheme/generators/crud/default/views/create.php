<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/** @var yii\web\View $this */
/** @var yii\gii\generators\crud\Generator $generator */

echo "<?php\n";
?>

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var <?= ltrim($generator->modelClass, '\\') ?> $model */

$this->title = <?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-create">

    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title"><?= "<?= " ?>Html::encode($this->title) ?></div>
            <div class="card-toolbar"></div>
        </div>
        <div class="card-body">

            <?= "<?= " ?>$this->render('_form', [
                'model' => $model,
            ]) ?>
        
        </div>
    </div>

</div>
