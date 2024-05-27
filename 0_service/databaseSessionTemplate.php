<?php 
    class ConnectDB {
        private static $instance = null;
        private $pdo;

        private $host = 'localhost';
        private $db = 'store';
        private $user = 'root';
        private $password = "";

        private function __construct(){
            $dsn = "mysql:host=$this->host;dbname=$this->db;charset=UTF8";
            $this->pdo = new PDO($dsn, $this->user, $this->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]); 
        }

        public static function getInstance(){
            if(!self::$instance){
                self::$instance = new ConnectDB();
            }

            return self::$instance;
        }

        public function getConnection(){
            return $this->pdo;
        }
    }

    function connectToDatabase(){
        $instance = ConnectDB::getInstance();
        $pdo = $instance->getConnection();

        return $pdo;
    }

    function setTemplate($pathToTemplate){
        require_once '../vendor/autoload.php';
        
        $twig = new \Twig\Environment(new \Twig\Loader\ArrayLoader());
        $templateContent = file_get_contents($pathToTemplate);

        $template = $twig->createTemplate($templateContent);
        return $template;
    }

    function requireSession(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
?>
