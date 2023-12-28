<?php

use yii\db\Migration;

/**
 * Class m180814_105953_create_table_settings
 */
class m180814_105953_create_table_settings extends Migration
{
    private $tableName = '{{%settings}}';
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            '[[setting_id]]' => $this->primaryKey(),
            '[[title]]' => $this->string(500),
            '[[description]]' => $this->text(),
            '[[slug]]' => $this->string(600),
            '[[type]]' => $this->integer(12),
            '[[input]]' => $this->integer(12),
            '[[data]]' => $this->text(),
            '[[default]]' => $this->string(255),
            '[[sort]]' => $this->integer(255),
            '[[lang_hash]]' => $this->string(255),
            '[[lang]]' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-settings-lang',
            $this->tableName,
            'lang'
        );

        $this->addForeignKey(
            'fk-settings-langs-lang',
            $this->tableName,
            '[[lang]]',
            '{{%langs}}',
            '[[lang_id]]',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {

        $this->dropTable($this->tableName);
    }
}
