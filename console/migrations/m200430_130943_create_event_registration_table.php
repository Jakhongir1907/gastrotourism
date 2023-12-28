<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%webinar_registration}}`.
 */
class m200430_130943_create_event_registration_table extends Migration
{
    public $table = '{{%event_registration}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'fullname' => $this->string(),
            'birth_date' => $this->string(),
            'address' => $this->string(),
            'experience' => $this->integer(),
            'work' => $this->string(),
            'position' => $this->string(),
            'phone_number' => $this->string(),
            'telegram_number' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'status' => $this->integer()
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
