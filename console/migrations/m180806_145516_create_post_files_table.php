<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post_files`.
 * Has foreign keys to the tables:
 *
 * - `post`
 * - `file`
 */
class m180806_145516_create_post_files_table extends Migration
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

        $this->createTable('post_files', [
          //  'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'file_id' => $this->integer()->notNull(),
            'sort'    => $this->integer(),
        ], $options);

        // creates index for column `post_id`
        $this->createIndex(
            'idx-post_files-post_id',
            'post_files',
            'post_id'
        );

        // add foreign key for table `post`
        $this->addForeignKey(
            'fk-post_files-post_id',
            'post_files',
            'post_id',
            'post',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-post_files-file_id',
            'post_files',
            'file_id'
        );

        // add foreign key for table `file`
        $this->addForeignKey(
            'fk-post_files-file_id',
            'post_files',
            'file_id',
            'files',
            'file_id',
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
            'fk-post_files-post_id',
            'post_files'
        );

        // drops index for column `post_id`
        $this->dropIndex(
            'idx-post_files-post_id',
            'post_files'
        );

        // drops foreign key for table `file`
        $this->dropForeignKey(
            'fk-post_files-file_id',
            'post_files'
        );

        $this->dropIndex(
            'idx-post_files-file_id',
            'post_files'
        );

        $this->dropTable('post_files');
    }
}
