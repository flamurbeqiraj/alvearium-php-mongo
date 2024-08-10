<?php
    require_once("./core/db.core.php");
    require_once("./core/general.core.php");
    use General as Gen;
    use MongoDB\BSON\ObjectId;
    class Read {
        protected $collection;
        protected $actionStatus;
        function __construct(Type $collection = null) {
            $database_name = isset($_SERVER["HTTP_DATABASE"]) ? $_SERVER["HTTP_DATABASE"] : 0;
            $collection_name = isset($_SERVER["HTTP_COLLECTION"]) ? $_SERVER["HTTP_COLLECTION"] : 0;
            $this->actionStatus = ($database_name && $collection_name) ? 1 : 0;
            $this->collection = (new MongoDB\Client)->$database_name->$collection_name;
        }

        public function read_single($uuid) {
            $gen = new Gen();
            $body = json_decode(file_get_contents('php://input'));
            try {
                $result = $gen->uuidObjectMapper($this->collection->findOne(['_id' => new ObjectId($uuid)]));
                echo json_encode(["code" => 200, "body" => $result, "message" => ""]);
            } catch (Exception $e) {
                printf($e->getMessage());
            }
        }

        public function read_all() {
            $gen = new Gen();
            $body = json_decode(file_get_contents('php://input'));
            try {
                $result = $gen->uuidArrayMapper($this->collection->find()->toArray());
                echo json_encode(["code" => 200, "body" => $result, "message" => ""]);
            } catch (Exception $e) {
                printf($e->getMessage());
            }
        }
    }