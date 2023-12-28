<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post_categories`.
 * Has foreign keys to the tables:
 *
 * - `post`
 * - `category`
 */
class m180810_191904_create_post_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('post_categories', [
            'post_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `post_id`
        $this->createIndex(
            'idx-post_categories-post_id',
            'post_categories',
            'post_id'
        );

        // add foreign key for table `post`
        $this->addForeignKey(
            'fk-post_categories-post_id',
            'post_categories',
            'post_id',
            'post',
            'id',
            'CASCADE'
        );

        // creates index for column `category_id`
        $this->createIndex(
            'idx-post_categories-category_id',
            'post_categories',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-post_categories-category_id',
            'post_categories',
            'category_id',
            'categories',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `post`
        $this->dropForeignKey(
            'fk-post_categories-post_id',
            'post_categories'
        );

        // drops index for column `post_id`
        $this->dropIndex(
            'idx-post_categories-post_id',
            'post_categories'
        );

        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-post_categories-category_id',
            'post_categories'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-post_categories-category_id',
            'post_categories'
        );

        $this->dropTable('post_categories');
    }
}
