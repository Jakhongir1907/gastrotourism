<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post_tags`.
 * Has foreign keys to the tables:
 *
 * - `post`
 * - `tag`
 */
class m180806_150045_create_post_tags_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $options = null;
        if($this->getDb()->getDriverName() == 'mysql') {
            $options = "character set utf8 collate utf8_general_ci engine=InnoDB";
        }

        $this->createTable('post_tags', [
            //'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
        ], $options);

        // creates index for column `post_id`
        $this->createIndex(
            'idx-post_tags-post_id',
            'post_tags',
            'post_id'
        );

        // add foreign key for table `post`
        $this->addForeignKey(
            'fk-post_tags-post_id',
            'post_tags',
            'post_id',
            'post',
            'id',
            'CASCADE'
        );

        // creates index for column `tag_id`
        $this->createIndex(
            'idx-post_tags-tag_id',
            'post_tags',
            'tag_id'
        );

        // add foreign key for table `tag`
        $this->addForeignKey(
            'fk-post_tags-tag_id',
            'post_tags',
            'tag_id',
            'tag',
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
            'fk-post_tags-post_id',
            'post_tags'
        );

        // drops index for column `post_id`
        $this->dropIndex(
            'idx-post_tags-post_id',
            'post_tags'
        );

        // drops foreign key for table `tag`
        $this->dropForeignKey(
            'fk-post_tags-tag_id',
            'post_tags'
        );

        // drops index for column `tag_id`
        $this->dropIndex(
            'idx-post_tags-tag_id',
            'post_tags'
        );

        $this->dropTable('post_tags');
    }
}
