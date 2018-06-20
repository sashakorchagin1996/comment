<?php

use yii\db\Migration;

/**
 * Handles the creation of table `email`.
 */
class m180619_132515_create_email_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('email', [
            'id' => $this->primaryKey(),
            'username' => $this->text()->unique(),
            'password' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('email');
    }
}
