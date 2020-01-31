<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $name
 *
 * @property AuthorBook[] $authorBooks
 * @property Book[] $books
 */
class Author extends \yii\db\ActiveRecord
{
    public $countBooks;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[AuthorBooks]].
     *
     * @return \yii\db\ActiveQuery|AuthorBookQuery
     */
    public function getAuthorBooks()
    {
        return $this->hasMany(AuthorBook::className(), ['author_id' => 'id']);
    }

    /**
     * Gets query for [[Books]].
     *
     * @return \yii\db\ActiveQuery|BookQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['id' => 'book_id'])->viaTable('author_book', ['author_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return AuthorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthorQuery(get_called_class());
    }
}
