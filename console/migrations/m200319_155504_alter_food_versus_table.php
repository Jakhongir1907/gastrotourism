<?php

use yii\db\Migration;

class m200319_155504_alter_food_versus_table extends Migration
{
    public $table = '{{%food_versus}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->table, 'lang', $this->integer());
        $this->addColumn($this->table, 'lang_hash', $this->string(255)->notNull());

        // creates index for column `lang`
        $this->createIndex(
            "idx-food_versus-lang",
            $this->table,
            'lang'
        );

        // add foreign key for table `language`
        $this->addForeignKey(
            "fk-food_versus-lang",
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
            "fk-food_versus-lang",
            $this->table
        );

        // drops index for column `lang`
        $this->dropIndex(
            "idx-food_versus-lang",
            $this->table
        );

    }
}
