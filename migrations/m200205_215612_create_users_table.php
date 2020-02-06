<?php

use yii\db\Migration;

/**
 * Class m200205_215612_create_users_table
 */
class m200205_215612_create_users_table extends Migration
{
    const USERS_TABLE = "{{%users}}";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        $this->createTable(self::USERS_TABLE, [
            'id' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'email' => $this->string()->unique(),
            'password' => $this->string()->notNull(),
            'user_ip' => $this->string(),
            'last_user_ip' => $this->string(),
            'last_login' => $this->integer()->notNull(),
            'birthday' => $this->integer()->defaultValue(null),

            'authKey' =>$this->string(),
            'accessToken'=>$this->string(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull()

        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::USERS_TABLE);
    }
}
