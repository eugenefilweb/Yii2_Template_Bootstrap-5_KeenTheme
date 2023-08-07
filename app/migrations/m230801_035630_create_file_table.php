<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%file}}`.
 */
class m230801_035630_create_file_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%file}}', [
            'id' => $this->bigPrimaryKey(),
            'name' => $this->string(),
            'location' => $this->text(),
            'extension' => $this->string(),
            'size' => $this->integer(),
            'token' => $this->string(),
            'record_status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->timestamp()->defaultValue(null)->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
            'created_by' => $this->bigInteger()->null(),
            'updated_by' => $this->bigInteger()->null(),
        ]);
        
        $this->createIndex('token', '{{%file}}', 'token');
        
        $this->createIndex('created_by', '{{%file}}', 'created_by');
        $this->createIndex('updated_by', '{{%file}}', 'updated_by');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%file}}');
    }
}
