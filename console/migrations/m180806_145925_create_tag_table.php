<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tag`.
 * Has foreign keys to the tables:
 *
 * - `language`
 */
class m180806_145925_create_tag_table extends Migration
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

        $this->createTable('tag', [
            'id' => $this->primaryKey(),
            'lang' => $this->integer()->notNull(),
            'name' => $this->string(255),
        ], $options);

        // creates index for column `lang`
        $this->createIndex(
            'idx-tag-lang',
            'tag',
            'lang'
        );

        // add foreign key for table `language`
        $this->addForeignKey(
            'fk-tag-lang',
            'tag',
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
            'fk-tag-lang',
            'tag'
        );

        // drops index for column `lang`
        $this->dropIndex(
            'idx-tag-lang',
            'tag'
        );

        $this->dropTable('tag');
    }
}
