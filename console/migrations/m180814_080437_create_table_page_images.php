<?php

use yii\db\Migration;

/**
 * Class m180814_080437_create_table_page_images
 */
class m180814_080437_create_table_page_images extends Migration
{
    private $tableName='{{%pagesimages}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tableName, [
            'page_id' => $this->integer(11),
            'file_id' => $this->integer(11),
            'sort' => $this->integer(11)
        ], $tableOptions);


        $this->createIndex(
            'idx-pagesimages-page_id',
            $this->tableName,
            'page_id'
        );

        $this->createIndex(
            'idx-pagesimages-file_id',
            $this->tableName,
            'file_id'
        );

        $this->addForeignKey(
            'fk-pagesimages-page_id',
            $this->tableName,
            'page_id',
            '{{%pages}}',
            'page_id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-pagesimages-file_id',
            $this->tableName,
            'file_id',
            '{{%files}}',
            'file_id',
            'CASCADE'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-pagesimages-page_id',$this->tableName);
        $this->dropIndex('idx-pagesimages-file_id',$this->tableName);
        $this->dropForeignKey('fk-pagesimages-page_id',$this->tableName);
        $this->dropForeignKey('fk-pagesimages-file_id',$this->tableName);

        $this->dropTable($this->tableName);
    }
}
