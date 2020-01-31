<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AuthorBook]].
 *
 * @see AuthorBook
 */
class AuthorBookQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AuthorBook[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AuthorBook|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
