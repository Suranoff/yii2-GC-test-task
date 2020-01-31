<?php

use yii\db\Migration;

/**
 * Class m200131_075758_add_users
 */
class m200131_075758_add_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%user}}', [
            'username' => 'test',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('test'),
            'email' => 'test@gmail.com',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200131_075758_add_users cannot be reverted.\n";

        return false;
    }
}
