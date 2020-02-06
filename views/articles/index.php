<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ArticlesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->id) : ?>
        <p>
            <?= Html::a('Create Articles', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'tags',
            'content:ntext',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        if (Yii::$app->user->id) {
                            return Html::a('<i class="fa fa-pencil"></i>', $url, [
                            ]);

                        }
                    },
                    'delete' => function ($url, $model) {
                        if (Yii::$app->user->id) {
                            return Html::a('<i class="fa  fa-trash"></i>', $url, [
                            ]);

                        }
                    },

                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
