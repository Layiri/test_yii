<?php

use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;
use yii\widgets\Pjax;

/* @var $this yii\web\View */

$this->title = 'My Yii Application for read articles';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome to my yii2 test site!</h1>

        <p class="lead">this site allows you to have summaries of articles</p>

        <?php if (Yii::$app->user->id) : ?>
            <p>
                <?= Html::a('Create article', ['articles/create'], ['class' => 'btn btn-success']) ?>
            </p>
        <?php endif; ?>
        </p>
    </div>


    <div class="body-content">

        <div class="row">
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
                        },
                        'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'created_at',
                            'dateFormat' => 'dd-MM-yyyy',
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ]),
                    ],

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
                        'filter' => DatePicker::widget([
                            'model' => $searchModel,
                            'attribute' => 'updated_at',
                            'dateFormat' => 'dd-MM-yyyy',
                            'options' => [
                                'class' => 'form-control',
                            ],
                        ]),
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function ($url, $model) {
                                if (Yii::$app->user->id) {
                                    return Html::a('<i class="fa fa-eye"></i>', ['articles/view', 'id' => $model->id], [
                                    ]);
                                }
                            },
                            'update' => function ($url, $model) {
                                if (Yii::$app->user->id) {
                                    return Html::a('<i class="fa fa-pencil"></i>', ['articles/update', 'id' => $model->id], [
                                    ]);
                                }
                            },
                            'delete' => function ($url, $model) {
                                if (Yii::$app->user->id) {
                                    return Html::a('<i class="fa  fa-trash"></i>', ['articles/delete', 'id' => $model->id],
                                        [
                                            'data' => [
                                                'confirm' => 'Are you sure you want to delete this item?',
                                                'method' => 'post',
                                            ],

                                        ]);
                                }
                            },
                        ]
                    ],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>

    </div>
</div>
