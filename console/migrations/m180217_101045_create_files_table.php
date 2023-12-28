<?php

use yii\db\Migration;

/**
 * Handles the creation of table `castings`.
 */
class m180217_101045_create_files_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%files}}', [
            '[[file_id]]' => $this->primaryKey(),
            '[[title]]' => $this->string(500),
            '[[description]]' => $this->text(),
            '[[type]]' => $this->string(255),
            '[[file]]' => $this->text(),
            '[[params]]' => $this->string(255),
            '[[date_create]]' => $this->integer(255)->notNull(),
            '[[converted]]' => $this->integer(255)->notNull()->defaultValue(0),
            '[[user_id]]' => $this->integer(255)
        ]);

        /*
        * Создание индекса для создание отношение:
         * Пользаватель - user_id
        */
        $this->createIndex(
            'idx-files-users-user-id',
            '{{%files}}',
            '[[user_id]]'
        );
        //Создание отношение
        $this->addForeignKey(
            'fk-files-users-user-id',
            '{{%files}}',
            '[[user_id]]',
            '{{%user}}',
            '[[id]]',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {

        /*
        * Удаление связи:
        * Пользаватель - user_id
        */
        $this->dropForeignKey(
            'fk-files-users-user-id',
            '{{%files}}'
        );

        $this->dropIndex(
            'idx-files-users-user-id',
            '{{%files}}'
        );


        $this->dropTable('{{%files}}');
    }
}
