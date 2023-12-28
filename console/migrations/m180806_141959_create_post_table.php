<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `language`
 */
class m180806_141959_create_post_table extends Migration
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

        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'author' => $this->integer()->notNull(),
            'title' => $this->string(),
            'description' => $this->text(),
            'slug' => $this->string(),
            'lang' => $this->integer(),
            'lang_hash' => $this->string(255)->notNull(),
            'type' => $this->integer(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'published_at' => $this->integer()->notNull(),
            'top' => $this->integer(),
            'viewed' => $this->integer(),
            'status' => $this->integer(),
            'meta_data' => $this->text(),
        ], $options);

        // creates index for column `author`
        $this->createIndex(
            'idx-post-author',
            'post',
            'author'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-post-author',
            'post',
            'author',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `lang`
        $this->createIndex(
            'idx-post-lang',
            'post',
            'lang'
        );

        // add foreign key for table `language`
        $this->addForeignKey(
            'fk-post-lang',
            'post',
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
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-post-author',
            'post'
        );

        // drops index for column `author`
        $this->dropIndex(
            'idx-post-author',
            'post'
        );

        // drops foreign key for table `language`
        $this->dropForeignKey(
            'fk-post-lang',
            'post'
        );

        // drops index for column `lang`
        $this->dropIndex(
            'idx-post-lang',
            'post'
        );

        $this->dropTable('post');
    }
}
