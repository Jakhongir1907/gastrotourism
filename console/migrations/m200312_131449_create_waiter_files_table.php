<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%waiter_files}}`.
 */
class m200312_131449_create_waiter_files_table extends Migration
{
    public $table = '{{%waiter_files}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'waiter_id' => $this->integer(),
            'file_id' => $this->integer(),
            'sort' => $this->integer()
        ]);

        $this->createIndex(
            "idx-waiter-waiter_id",
            $this->table,
            'waiter_id'
        );

        $this->createIndex(
            "idx-waiter-file_id",
            $this->table,
            'file_id'
        );

        $this->addForeignKey(
            "fk-waiter-waiter_id",
            $this->table,
            'waiter_id',
            '{{%waiter}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            "fk-waiter-file_id",
            $this->table,
            'file_id',
            '{{%files}}',
            'file_id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey("fk-waiter-waiter_id", $this->table);
        $this->dropForeignKey("fk-waiter-file_id", $this->table);
        $this->dropIndex("idx-waiter-waiter_id", $this->table);
        $this->dropIndex("idx-waiter-file_id", $this->table);
        $this->dropTable($this->table);
    }
}
