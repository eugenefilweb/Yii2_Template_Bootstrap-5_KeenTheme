<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m230801_003009_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->bigPrimaryKey(),
            'role_id' => $this->smallInteger()->notNull(),
            'username' => $this->string()->notNull()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'verification_token' => $this->string()->defaultValue(null),
            'auth_key' => $this->string(32)->notNull(),
            'access_token' => $this->string(32)->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'record_status' => $this->smallInteger()->defaultValue(1),
            'is_blocked' => $this->smallInteger()->defaultValue(0),
            'created_at' => $this->timestamp()->defaultValue(null)->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'),
            'created_by' => $this->bigInteger()->null(),
            'updated_by' => $this->bigInteger()->null(),
        ], $tableOptions);

        $this->createIndex('role_id', '{{%user}}', 'role_id');
        $this->createIndex('auth_key', '{{%user}}', 'auth_key');
        $this->createIndex('access_token', '{{%user}}', 'access_token');
        
        $this->createIndex('created_by', '{{%user}}', 'created_by');
        $this->createIndex('updated_by', '{{%user}}', 'updated_by');
    
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
