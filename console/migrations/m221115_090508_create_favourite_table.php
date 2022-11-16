<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%favourite}}`.
 */
class m221115_090508_create_favourite_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('favourite', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'post_id' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-favourite-user_id',
            'favourite',
            'user_id'
        );
        $this->addForeignKey(
            'fk-favourite-user_id',
            'favourite',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-favourite-post_id',
            'favourite',
            'post_id'
        );
        $this->addForeignKey(
            'fk-favourite-post_id',
            'favourite',
            'post_id',
            'post',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%favourite}}');
    }
}
