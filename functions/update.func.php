<?php
    require_once("./core/db.core.php");
    require_once("./core/general.core.php");
    use General as Gen;
    use MongoDB\BSON\ObjectId;

    class Update {
        protected $collection;
        protected $actionStatus;
        function __construct(Type $collection = null) {
            $connection = new Database();
            $database_name = isset($_SERVER["HTTP_DATABASE"]) ? $_SERVER["HTTP_DATABASE"] : 0;
            $collection_name = isset($_SERVER["HTTP_COLLECTION"]) ? $_SERVER["HTTP_COLLECTION"] : 0;
            $this->actionStatus = ($database_name && $collection_name) ? 1 : 0;
            $this->collection = $connection->connect_db()->$database_name->$collection_name;
        }

        public function update($uuid) {
            $body = json_decode(file_get_contents('php://input'), true);
            $gen = new Gen();
            try {
                $this->collection->updateOne([
                    '_id' => new ObjectId($uuid)
                ], ['$set' => $body]);
                echo json_encode(["code" => 200, "message" => "Updated successfuly!"]);
            } catch (Exception $e) {
                printf($e->getMessage());
            }
        }
    }