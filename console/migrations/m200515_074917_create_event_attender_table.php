<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%event_attender}}`.
 */
class m200515_074917_create_event_attender_table extends Migration
{

    private $table = '{{%event_attender}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'email' => $this->string(),
            'event_id' => $this->integer()
        ]);

        $this->createIndex(
            'idx-event_attender-event_id',
            $this->table,
            'event_id'
        );

        $this->addForeignKey(
            'fk-event_attender-event_id-event-id',
            $this->table,
            'event_id',
            '{{%event}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }
}
