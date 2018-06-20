<?php

use yii\db\Migration;

/**
 * Handles the creation of table `proxy`.
 */
class m180619_132234_create_proxy_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('proxy', [
            'id' => $this->primaryKey(),
            'ip' => $this->text(),
            'port' => $this->text(),
            'password' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('proxy');
    }
}
