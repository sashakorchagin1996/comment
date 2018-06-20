<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proxy".
 *
 * @property int $id
 * @property string $ip
 * @property string $port
 * @property string $password
 *
 * @property Account[] $accounts
 */
class Proxy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proxy';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ip', 'port', 'password'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'Ip',
            'port' => 'Port',
            'password' => 'Password',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccounts()
    {
        return $this->hasMany(Account::className(), ['proxy_id' => 'id']);
    }
}
