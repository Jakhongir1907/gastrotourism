<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food}}`.
 */
class m200229_191156_create_food_table extends Migration
{

    public $table = '{{%food}}';

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
            'ingredients' => $this->text(),
            'cook_steps' => $this->text(),
            'lang' => $this->integer(),
            'lang_hash' => $this->string(255)->notNull()
        ]);

        // creates index for column `lang`
        $this->createIndex(
            "idx-food-lang",
            $this->table,
            'lang'
        );

        // add foreign key for table `language`
        $this->addForeignKey(
            "fk-food-lang",
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
            "fk-food-lang",
            $this->table
        );

        // drops index for column `lang`
        $this->dropIndex(
            "idx-food-lang",
            $this->table
        );

        $this->dropTable($this->table);
    }
}
