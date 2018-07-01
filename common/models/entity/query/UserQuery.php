<?php

namespace common\models\entity\query;

/**
 * This is the ActiveQuery class for [[\common\models\entity\User]].
 *
 * @see \common\models\entity\User
 */
class UserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \common\models\entity\User[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\entity\User|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
