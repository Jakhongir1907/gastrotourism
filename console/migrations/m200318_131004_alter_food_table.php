<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%food}}`.
 */
class m200318_131004_alter_food_table extends Migration
{
    public $table = '{{%food}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn($this->table, 'top', $this->integer());
        $this->addColumn($this->table, 'country_id', $this->integer());

        // creates index for column `lang`
        $this->createIndex(
            "idx-food-country_id",
            $this->table,
            'lang'
        );

        // add foreign key for table `language`
        $this->addForeignKey(
            "fk-food-country_id-country-id",
            $this->table,
            'country_id',
            'country',
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
            "fk-food-country_id-country-id",
            $this->table
        );

        // drops index for column `lang`
        $this->dropIndex(
            "idx-food-country_id",
            $this->table
        );

        $this->dropColumn($this->table, 'top');
        $this->dropColumn($this->table, 'country_id');
    }
}
