<?php 
    require_once __DIR__ . '/../../config/Connection.php';
    class Theme
    {
        private $nomTheme;
        private $description;
        private $imageTheme;

        public function __construct($nomTheme = null, $description = null, $imageTheme = null){
            $this->nomTheme = $nomTheme;
            $this->description = $description;
            $this->imageTheme = $imageTheme;
        }

        public function __get($name) {
            return $this->$name;
        }

        public function __set($property, $value) {
            $this->$property = $value;
        }

        public function getAllTheme(){
            $db = Connection::connect();
            $sqlTheme = "SELECT idTheme, nomTheme, description, imageTheme FROM theme";
            $stmt = $db->prepare($sqlTheme);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }


    }
?>
