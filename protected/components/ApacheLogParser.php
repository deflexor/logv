<?php

class ApacheLogParser
{
    function parseApacheLogs($logFilePath)
    {
        // Regular expression pattern to match Apache log lines
        $pattern = '/^(\S+) (\S+) (\S+) \[([^\]]+)\] "(\S+) (\S+) (\S+)" (\d+) (\S+)/';
        
        $logs = [];
        
        // Read the log file line by line
        $handle = fopen($logFilePath, 'r');
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                // Match the log line against the pattern
                if (preg_match($pattern, $line, $matches)) {
                    $logEntry = [
                        'ip' => $matches[1],
                        'ident' => $matches[2],
                        'user' => $matches[3],
                        'timestamp' => $matches[4],
                        'request' => $matches[5],
                        'status' => $matches[8],
                        'size' => $matches[9],
                    ];
                    
                    // Add the parsed log entry to the logs array
                    $logs[] = $logEntry;
                }
            }
            
            fclose($handle);
        } else {
            echo "Error opening log file.";
        }
        
        return $logs;
    }
    
    
    function writeDataBatch($data)
    {
        $connection = Yii::app()->db;
        $transaction = $connection->beginTransaction();
        
        try {
            $command = $connection->createCommand();
            
            foreach ($data as $row) {
                $command->insert('apache_log', $row);
            }
            
            $command->execute();
            $transaction->commit();
        } catch (Exception $e) {
        $transaction->rollback();
        throw $e;
    }
}

// Usage example
// $data = [
//     ['column1' => 'value1', 'column2' => 'value2'],
//     ['column1' => 'value3', 'column2' => 'value4'],
//     // Add more rows as needed
// ];

// writeDataInBatches($data, 100);


// // Usage example
//  $logFilePath = '/path/to/access.log';
// $logs = parseApacheLogs($logFilePath);

// // Process the parsed logs
// foreach ($logs as $log) {
//     // Example: display the IP address and status of each log entry
//     echo "IP: " . $log['ip'] . ", Status: " . $log['status'] . "\n";
// }

}
