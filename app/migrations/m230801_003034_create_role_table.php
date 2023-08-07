<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%role}}`.
 */
class m230801_003034_create_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%role}}', [
            'id' => $this->bigPrimaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'module_access' => $this->text(),
            'role_access' => $this->text(),
            'navigations' => $this->text(),
            'level' => $this->smallInteger()->unique(),
            'record_status' => $this->smallInteger()->defaultValue(1),
            'created_at' => $this->timestamp()->defaultValue(null)->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
            'created_by' => $this->bigInteger()->null(),
            'updated_by' => $this->bigInteger()->null(),
        ], $tableOptions);

        
        $this->createIndex('created_by', '{{%role}}', 'created_by');
        $this->createIndex('updated_by', '{{%role}}', 'updated_by');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%role}}');
    }
}
