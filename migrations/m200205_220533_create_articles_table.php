<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%articles}}`.
 */
class m200205_220533_create_articles_table extends Migration
{
    const ARTICLES_TABLE = '{{%articles}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        $this->createTable(self::ARTICLES_TABLE, [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'tags' => $this->string(),
            'content' => $this->text(),
            'created_at' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull()->defaultValue(0),
            'updated_at' => $this->integer()->notNull(),
            'updated_by' => $this->integer()->notNull()->defaultValue(0),
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::ARTICLES_TABLE);
    }
}
