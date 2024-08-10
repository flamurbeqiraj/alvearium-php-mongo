<?php
    require_once("./core/db.core.php");

    use MongoDB\BSON\ObjectId;
    
    class Create {
        protected $collection;
        protected $actionStatus;
        function __construct(Type $collection = null) {
            $database_name = isset($_SERVER["HTTP_DATABASE"]) ? $_SERVER["HTTP_DATABASE"] : 0;
            $collection_name = isset($_SERVER["HTTP_COLLECTION"]) ? $_SERVER["HTTP_COLLECTION"] : 0;
            $this->actionStatus = ($database_name && $collection_name) ? 1 : 0;
            $this->collection = (new MongoDB\Client)->$database_name->$collection_name;
        }

        public function create() {
            if (!$this->actionStatus) {
                echo json_encode(["code" => 400, "message" => "Missing [Database name] or [Collection name] in header!"]);
                exit;
            }
            $body = json_decode(file_get_contents('php://input'));
            try {
                $this->collection->insertOne($body);
                echo json_encode(["code" => 200, "message" => "Created successfuly!"]);
            } catch (Exception $e) {
                printf($e->getMessage());
            }
        }
    }