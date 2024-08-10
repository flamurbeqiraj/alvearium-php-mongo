<?php
    use MongoDB\Client;
    use MongoDB\Driver\ServerApi;
    
    class Database {
        protected $url;
        public function __construct(Type $var = null) {
            $this->var = $_ENV["MONGODB_URL"];
        }
        public function connect_db() {
            $apiVersion = new ServerApi(ServerApi::V1);
            return new MongoDB\Client($this->uri, [], ['serverApi' => $apiVersion]);
        }
    }
?>