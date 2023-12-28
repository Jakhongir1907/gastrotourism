<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fruit}}`.
 */
class m200317_152856_create_fruit_table extends Migration
{

    public $table = '{{%fruit}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->text(),
            'price' => $this->integer(),
            'lang' => $this->integer(),
            'lang_hash' => $this->string(255)->notNull()
        ]);

        // creates index for column `lang`
        $this->createIndex(
            "idx-fruit-lang",
            $this->table,
            'lang'
        );

        // add foreign key for table `language`
        $this->addForeignKey(
            "fk-fruit-lang",
            $this->table,
            'lang',
            'langs',
            'lang_id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `language`
        $this->dropForeignKey(
            "fk-fruit-lang",
            $this->table
        );

        // drops index for column `lang`
        $this->dropIndex(
            "idx-fruit-lang",
            $this->table
        );

        $this->dropTable($this->table);
    }
}
