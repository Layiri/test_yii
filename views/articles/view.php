<?php

use app\models\User;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Articles */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="articles-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->id) : ?>

        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    <?php endif; ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'tags',
            'content:ntext',
            'created_by' => [
                'attribute' => 'created_by',
                'format' => 'html',
                'value' => function ($model) {
                    $userName = User::find()->where("id=$model->created_by")->one();
                    if ($userName) {
                        return $userName->first_name . ' ' . $userName->last_name;
                    }
                    return $model->created_by;
                },
            ],
            'created_at' => [
                'attribute' => 'created_at',
                'format' => 'html',
                'value' => function ($model) {
                    return date("d-m-Y", $model->created_at);
                }],

            'updated_by' => [
                'attribute' => 'updated_by',
                'format' => 'html',
                'value' => function ($model) {
                    $userName = User::find()->where("id=$model->updated_by")->one();
                    if ($userName) {
                        return $userName->first_name . ' ' . $userName->last_name;
                    }
                    return $model->updated_by;
                },
            ],
            'updated_at' => [
                'attribute' => 'updated_at',
                'format' => 'html',
                'value' => function ($model) {
                    return date("d-m-Y", $model->updated_at);
                },
            ],
        ],
    ]) ?>

</div>
