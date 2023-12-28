<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%festival_files}}`.
 */
class m200227_035706_create_festival_files_table extends Migration
{

    public $table = '{{%festival_files}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'festival_id' => $this->integer(),
            'file_id' => $this->integer(),
            'sort' => $this->integer()
        ]);

        $this->createIndex(
            "idx-festival-festival_id",
            $this->table,
            'festival_id'
        );

        $this->createIndex(
            "idx-festival-file_id",
            $this->table,
            'file_id'
        );

        $this->addForeignKey(
            "fk-festival-festival_id",
            $this->table,
            'festival_id',
            '{{%festival}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            "fk-festival-file_id",
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
        $this->dropForeignKey("fk-festival-festival_id", $this->table);
        $this->dropForeignKey("fk-festival-file_id", $this->table);
        $this->dropIndex("idx-festival-festival_id", $this->table);
        $this->dropIndex("idx-festival-file_id", $this->table);

        $this->dropTable($this->table);
    }
}
