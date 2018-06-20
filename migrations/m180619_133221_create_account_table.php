<?php

use yii\db\Migration;

/**
 * Handles the creation of table `account`.
 * Has foreign keys to the tables:
 *
 * - `proxy`
 * - `email`
 */
class m180619_133221_create_account_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('account', [
            'id' => $this->primaryKey(),
            'proxy_id' => $this->integer(),
            'email_id' => $this->integer(),
            'username' => $this->string()->unique(),
            'password' => $this->text(),
        ]);

        // creates index for column `proxy_id`
        $this->createIndex(
            'idx-account-proxy_id',
            'account',
            'proxy_id'
        );

        // add foreign key for table `proxy`
        $this->addForeignKey(
            'fk-account-proxy_id',
            'account',
            'proxy_id',
            'proxy',
            'id',
            'CASCADE'
        );

        // creates index for column `email_id`
        $this->createIndex(
            'idx-account-email_id',
            'account',
            'email_id'
        );

        // add foreign key for table `email`
        $this->addForeignKey(
            'fk-account-email_id',
            'account',
            'email_id',
            'email',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `proxy`
        $this->dropForeignKey(
            'fk-account-proxy_id',
            'account'
        );

        // drops index for column `proxy_id`
        $this->dropIndex(
            'idx-account-proxy_id',
            'account'
        );

        // drops foreign key for table `email`
        $this->dropForeignKey(
            'fk-account-email_id',
            'account'
        );

        // drops index for column `email_id`
        $this->dropIndex(
            'idx-account-email_id',
            'account'
        );

        $this->dropTable('account');
    }
}
