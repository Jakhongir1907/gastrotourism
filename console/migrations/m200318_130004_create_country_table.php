<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%country}}`.
 */
class m200318_130004_create_country_table extends Migration
{
    public $table = '{{%country}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'name' => $this->integer(),
            'flag_path' => $this->integer(),
            'lang' => $this->integer(),
            'lang_hash' => $this->string(255)->notNull()
        ]);

        // creates index for column `lang`
        $this->createIndex(
            "idx-country-lang",
            $this->table,
            'lang'
        );

        // add foreign key for table `language`
        $this->addForeignKey(
            "fk-country-lang",
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
            "fk-country-lang",
            $this->table
        );

        // drops index for column `lang`
        $this->dropIndex(
            "idx-country-lang",
            $this->table
        );

        $this->dropTable($this->table);
    }
}
