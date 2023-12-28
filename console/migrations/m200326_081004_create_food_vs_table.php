<?php

use yii\db\Migration;

class m200326_081004_create_food_vs_table extends Migration
{
    public $table = '{{%food_vs}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'first_food_name' => $this->string(),
            'second_food_name' => $this->string(),
            'first_food_description' => $this->text(),
            'second_food_description' => $this->text(),
            'first_food_picture' => $this->string(),
            'second_food_picture' => $this->string(),
            'first_food_flag' => $this->string(),
            'second_food_flag' => $this->string(),
            'first_likes' => $this->integer(),
            'second_likes' => $this->integer(),
            'lang' => $this->integer(),
            'lang_hash' => $this->string(255)->notNull()
        ]);

        // creates index for column `lang`
        $this->createIndex(
            "idx-food_vs-lang",
            $this->table,
            'lang'
        );

        // add foreign key for table `language`
        $this->addForeignKey(
            "fk-food_vs-lang",
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
            "fk-food_vs-lang",
            $this->table
        );

        // drops index for column `lang`
        $this->dropIndex(
            "idx-food_vs-lang",
            $this->table
        );

    }
}
