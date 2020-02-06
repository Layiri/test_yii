<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $email
 * @property string $password
 * @property string|null $user_ip
 * @property string|null $last_user_ip
 * @property int $last_login
 * @property int|null $birthday
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'password', 'last_login'], 'required'],
            [['last_login', 'birthday'], 'integer'],
            [['first_name', 'last_name', 'email', 'password', 'user_ip', 'last_user_ip'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'password' => 'Password',
            'user_ip' => 'User Ip',
            'last_user_ip' => 'Last User Ip',
            'last_login' => 'Last Login',
            'birthday' => 'Birthday',
        ];
    }

    public function setPassword($password){
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\UsersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\UsersQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

}
