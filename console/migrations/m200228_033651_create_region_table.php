<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%region}}`.
 */
class m200228_033651_create_region_table extends Migration
{

    public $table = '{{%region}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->text(),
            'slug' => $this->string(255),
            'lang' => $this->integer(),
            'lang_hash' => $this->string(255)->notNull(),
        ]);

        // creates index for column `lang`
        $this->createIndex(
            "idx-region-lang",
            $this->table,
            'lang'
        );

        // add foreign key for table `language`
        $this->addForeignKey(
            "fk-region-lang",
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
            "fk-region-lang",
            $this->table
        );

        // drops index for column `lang`
        $this->dropIndex(
            "idx-region-lang",
            $this->table
        );

        $this->dropTable($this->table);
    }
}
