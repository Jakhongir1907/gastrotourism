<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%mail_queue}}`.
 */
class m200515_074929_create_mail_queue_table extends Migration
{

    private $table = '{{%mail_queue}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'email' => $this->string(),
            'subject' => $this->string(),
            'body' => $this->text(),
            'status' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer(),
            'send_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
