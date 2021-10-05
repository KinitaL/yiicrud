<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tokens}}`.
 */
class m211005_120055_create_tokens_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tokens}}', [
            'id' => $this->primaryKey(),
            'value'=>$this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tokens}}');
    }
}
