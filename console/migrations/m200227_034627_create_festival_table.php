<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%festival}}`.
 */
class m200227_034627_create_festival_table extends Migration
{

    public $table = '{{%festival}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'anons' => $this->text(),
            'site_url' => $this->string(),
            'date' => $this->integer(),
            'lang' => $this->integer(),
            'lang_hash' => $this->string(255)->notNull()
        ]);

        // creates index for column `lang`
        $this->createIndex(
            "idx-festival-lang",
            $this->table,
            'lang'
        );

        // add foreign key for table `language`
        $this->addForeignKey(
            "fk-festival-lang",
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
            "fk-festival-lang",
            $this->table
        );

        // drops index for column `lang`
        $this->dropIndex(
            "idx-festival-lang",
            $this->table
        );

        $this->dropTable($this->table);
    }
}
