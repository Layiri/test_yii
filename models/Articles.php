<?php

namespace app\models;

use Codeception\PHPUnit\Constraint\Page;
use Yii;

/**
 * This is the model class for table "{{%articles}}".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $tags
 * @property string|null $content
 * @property int $created_at
 * @property int $created_by
 * @property int $updated_at
 * @property int $updated_by
 */
class Articles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%articles}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
//            [['created_at', 'updated_at'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['title', 'tags'], 'string', 'max' => 255],
        ];
    }

    public function beforeSave($insert)
    {
        if($this->isNewRecord){
            $this->created_at = time();
            $this->created_by = Yii::$app->user->id;
        }
        $this->updated_at = time();
        $this->updated_by = Yii::$app->user->id;

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'tags' => 'Tags',
            'content' => 'Content',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\ArticlesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ArticlesQuery(get_called_class());
    }
}
