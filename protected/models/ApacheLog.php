<?php 

// protected/models/ApacheLog.php
class ApacheLog extends CActiveRecord
{
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'apache_logs'; // Replace 'apache_logs' with your actual table name
    }

    public function primaryKey()
    {
        return 'id'; // Replace 'id' with your actual primary key field
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'user' => 'User',
            'request' => 'Request',
            'ip' => 'IP',
            'status' => 'Status',
            'size' => 'Size',
            'timestamp' => 'Timestamp',
        );
    }
}
