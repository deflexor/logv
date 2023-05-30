<php?

class ConfigParser {
    public static function parseConfig($cfgPath)
    {
        //
    }
    
    function readYamlConfig($configFilePath)
    {
        $yaml = file_get_contents($configFilePath);
        
        // Convert YAML to associative array
        $config = yaml_parse($yaml);
        
        if ($config === false) {
            echo "Error reading YAML config.";
            return null;
        }
        
        return $config;
    }
    
    // Usage example
    $configFilePath = '/path/to/config.yaml';
    $config = readYamlConfig($configFilePath);
    
    // Access the configuration values
    if ($config !== null) {
        // Example: accessing a value from the config
        $databaseHost = $config['database']['host'];
        $databasePort = $config['database']['port'];
        // ... continue accessing other config values
    }
}