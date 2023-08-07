<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%session}}`.
 */
class m230801_003023_create_session_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $dataType = $this->binary();
        $tableOptions = null;

        switch ($this->db->driverName) {
            case 'mysql':
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
                break;
            case 'sqlsrv':
            case 'mssql':
            case 'dblib':
                $dataType = $this->text();
                break;
        }

        $this->createTable('{{%session}}', [
            'id' => $this->string()->notNull(),
            'expire' => $this->integer(),
            'data' => $dataType,
            'PRIMARY KEY ([[id]])',
        ], $tableOptions);

        $this->addColumn('{{%session}}', 'user_id', $this->integer()->defaultValue(null));
        $this->addColumn('{{%session}}', 'ip', $this->string()->defaultValue(null));
        $this->addColumn('{{%session}}', 'created_at', $this->timestamp()->defaultValue(null)->defaultExpression('CURRENT_TIMESTAMP'));
        $this->addColumn('{{%session}}', 'updated_at', $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'));

        $this->addColumn('{{%session}}', 'record_status', $this->smallInteger()->defaultValue(1));
        $this->addColumn('{{%session}}', 'created_by', $this->bigInteger()->null());
        $this->addColumn('{{%session}}', 'updated_by', $this->bigInteger()->null());
        
        $this->createIndex('created_by', '{{%session}}', 'created_by');
        $this->createIndex('updated_by', '{{%session}}', 'updated_by');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%session}}');
    }
}
