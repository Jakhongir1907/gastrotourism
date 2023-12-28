<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_login}}`.
 */
class m191105_102637_create_user_login_table extends Migration
{

    public $table = '{{%user_login}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'login_date' => $this->integer()->notNull(),
            'ip_address' => $this->string(),
            'user_agent' => $this->string(),
            'session_id' => $this->string()
        ]);

        $this->createIndex(
            'idx-user_login-user_id',
            $this->table,
            '[[user_id]]'
        );

        $this->addForeignKey(
            'fk-user_login-user_id-user-id',
            $this->table,
            '[[user_id]]',
            '{{%user}}',
            '[[id]]',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-user_login-user_id-user-id',
            $this->table
        );

        $this->dropIndex(
            'idx-user_login-user_id',
            $this->table
        );

        $this->dropTable($this->table);
    }
}
