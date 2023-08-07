<?php

use yii\db\Migration;

/**
 * Class m230801_021113_add_default_role_table
 */
class m230801_021113_add_default_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'module_access' => json_encode(Yii::$app->params['roles']['super-admin']['module_access']),
                'role_access' => json_encode(Yii::$app->params['roles']['super-admin']['role_access']),
                'navigations' => json_encode(Yii::$app->params['roles']['super-admin']['navigations']), 
                'level' => 1,
            ],
            [
                'name' => 'Admin',
                'module_access' => json_encode(Yii::$app->params['roles']['admin']['module_access']),
                'role_access' => json_encode(Yii::$app->params['roles']['admin']['role_access']),
                'navigations' => json_encode(Yii::$app->params['roles']['admin']['navigations']), 
                'level' => 2,
            ],
            [
                'name' => 'User',
                'module_access' => json_encode(Yii::$app->params['roles']['user']['module_access']),
                'role_access' => json_encode(Yii::$app->params['roles']['user']['role_access']),
                'navigations' => json_encode(Yii::$app->params['roles']['user']['navigations']), 
                'level' => 3,
            ],
        ];

        
        foreach ($roles as $key => $role) {
            $this->insert('{{%role}}', [
                'name' => $role['name'],
                'module_access' => $role['module_access'],
                'role_access' => $role['role_access'],
                'navigations' => $role['navigations'],
                'level' => $role['level'],
                'created_at' => new \yii\db\Expression('UTC_TIMESTAMP'),
                'updated_at' => new \yii\db\Expression('UTC_TIMESTAMP'),
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230801_021113_add_default_role_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230801_021113_add_default_role_table cannot be reverted.\n";

        return false;
    }
    */
}
