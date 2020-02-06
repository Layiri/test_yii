<?php

use yii\db\Migration;

/**
 * Class m200205_224125_add_default_user_data
 */
class m200205_224125_add_default_user_data extends Migration
{
    const USERS_TABLE = "{{%users}}";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->insert(self::USERS_TABLE, [
            'first_name' => 'Admin',
            'last_name' => 'Default',
            'password' => Yii::$app->security->generatePasswordHash('admin'),
            'email' => 'mail@mail.com',
            'user_ip' => '',
            'last_user_ip' => '',
            'last_login' => time(),
            'birthday' => 946684800,
            'authKey' => 'test100key',
            'accessToken' => '100-token',
            'created_at' => time(),
            'updated_at' => time()
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete(self::USERS_TABLE, ['email' => 'mail@mail.com']);
    }
}
