<?php

use yii\db\Migration;

/**
 * Class m200131_075300_add_authors
 */
class m200131_075300_add_authors extends Migration
{
    private $authorTable = '{{%author}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert($this->authorTable, [
            'name' => 'Author 1',
        ]);
        $this->insert($this->authorTable, [
            'name' => 'Author 2',
        ]);
        $this->insert($this->authorTable, [
            'name' => 'Author 3',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200131_075300_add_authors cannot be reverted.\n";

        return false;
    }
}
