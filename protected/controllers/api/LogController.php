<?php

class LogController extends AuthController
{
    public function actionView($id)
    {
        // Implement the logic to view a log entry by ID
    }
    
    public function actionGetLogsGroupedByIP()
    {
        // Query the ApacheLog model to retrieve logs grouped by IP
        $logs = ApacheLog::model()
            ->select('ip, COUNT(*) as count')
            ->group('ip')
            ->findAll();

        // Prepare an array to hold the log data
        $logData = array();

        // Iterate through the logs and extract the IP and count
        foreach ($logs as $log) {
            $logData[] = array(
                'ip' => $log->ip,
                'count' => $log->count,
            );
        }

        // Output the log data as JSON
        header('Content-type: application/json');
        echo json_encode($logData);
    }
    
    public function actionGetLogsByDate($date)
    {
        // Convert the provided date to a timestamp
        $timestamp = strtotime($date);

        // Format the timestamp to match the date format in your database
        $formattedDate = date('Y-m-d', $timestamp);

        // Query the ApacheLog model to retrieve logs filtered by the date
        $logs = ApacheLog::model()->findAll('DATE(timestamp) = :date', array(':date' => $formattedDate));

        // Prepare an array to hold the log data
        $logData = array();

        // Iterate through the logs and extract the desired fields
        foreach ($logs as $log) {
            $logData[] = array(
                'id' => $log->id,
                'user' => $log->user,
                'request' => $log->request,
                'ip' => $log->ip,
                'status' => $log->status,
                'size' => $log->size,
                'timestamp' => $log->timestamp,
            );
        }

        // Output the log data as JSON
        header('Content-type: application/json');
        echo json_encode($logData);
    }
    
    public function beforeAction($action)
    {
        // Ensure that the user is authenticated by validating the JWT token
        if (!$this->authenticate()) {
            throw new CHttpException(401, 'Unauthorized');
        }
        
        return parent::beforeAction($action);
    }
    
    protected function authenticate()
    {
        // Get the JWT token from the request headers
        $token = Yii::app()->request->getHeaders()->get('Authorization');
        $token = str_replace('Bearer ', '', $token);
        
        return JwtHelper::validateToken($token);
    }
    
    
}
