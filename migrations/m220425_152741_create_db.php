<?php

use yii\db\Schema;
use yii\db\Migration;

class m220425_152741_create_db extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL'
        ]);
        $this->createTable('article', [
            'id' => Schema::TYPE_PK,
            'category_id' => Schema::TYPE_INTEGER . ' NOT NULL', 
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'status' => Schema::TYPE_TINYINT . ' DEFAULT 0',
            'description' => Schema::TYPE_TEXT . ' NOT NULL',
            'created_at' => Schema::TYPE_TIMESTAMP
        ]);
        $this->createIndex(
            'idx-article-category_id',
            'article',
            'category_id'
        );
        $this->addForeignKey(
            'fk-article-category_id',
            'article',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );
        $this->insert('category', [
            'title' => 'category 1'
        ]);
        $this->insert('category', [
            'title' => 'category 2'
        ]);
        $this->insert('article', [
            'category_id' => '1',
            'title' => 'article 1',
            'description' => 'descriprion 1'
        ]);
        $this->insert('article', [
            'category_id' => '1',
            'title' => 'article 2',
            'description' => 'descriprion 2'
        ]);
        $this->insert('article', [
            'category_id' => '2',
            'title' => 'article 3',
            'description' => 'descriprion 3'
        ]);
        $this->insert('article', [
            'category_id' => '2',
            'title' => 'article 4',
            'description' => 'descriprion 4'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-article-category_id',
            'article'
        );
        $this->dropIndex(
            'idx-article-category_id',
            'article'
        );
        $this->dropTable('article');
        $this->dropTable('category');
    }
}
