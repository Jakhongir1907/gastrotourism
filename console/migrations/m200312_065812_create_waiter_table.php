<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%waiter}}`.
 */
class m200312_065812_create_waiter_table extends Migration
{

    public $table = '{{%waiter}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id' => $this->primaryKey(),
            'restaurant_id' => $this->integer()->notNull(),
            'name' => $this->string(),
            'position' => $this->string(),
            'lang' => $this->integer(),
            'lang_hash' => $this->string(255)->notNull()
        ]);

        // creates index for column `lang`
        $this->createIndex(
            "idx-waiter-lang",
            $this->table,
            'lang'
        );

        // add foreign key for table `language`
        $this->addForeignKey(
            "fk-waiter-lang",
            $this->table,
            'lang',
            'langs',
            'lang_id',
            'CASCADE'
        );

        // creates index for column `lang`
        $this->createIndex(
            "idx-waiter-restaurant_id",
            $this->table,
            'restaurant_id'
        );

        // add foreign key for table `language`
        $this->addForeignKey(
            "fk-waiter-restaurant_id-restaurant-id",
            $this->table,
            'restaurant_id',
            'restaurant',
            'id',
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
            "fk-waiter-lang",
            $this->table
        );

        // drops index for column `lang`
        $this->dropIndex(
            "idx-waiter-lang",
            $this->table
        );

        // drops foreign key for table `language`
        $this->dropForeignKey(
            "fk-waiter-restaurant_id-restaurant-id",
            $this->table
        );

        // drops index for column `lang`
        $this->dropIndex(
            "idx-waiter-restaurant_id",
            $this->table
        );


        $this->dropTable($this->table);
    }
}
