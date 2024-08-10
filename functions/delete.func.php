<?php
    require_once("./core/db.core.php");
    require_once("./core/general.core.php");
    use General as Gen;
    use MongoDB\BSON\ObjectId;
    class Delete {
        protected $collection;
        protected $actionStatus;
        function __construct(Type $collection = null) {
            $database_name = isset($_SERVER["HTTP_DATABASE"]) ? $_SERVER["HTTP_DATABASE"] : 0;
            $collection_name = isset($_SERVER["HTTP_COLLECTION"]) ? $_SERVER["HTTP_COLLECTION"] : 0;
            $this->actionStatus = ($database_name && $collection_name) ? 1 : 0;
            $this->collection = (new MongoDB\Client)->$database_name->$collection_name;
        }

        public function delete($uuid) {
            $gen = new Gen();
            try {
                $result = $this->collection->deleteOne(["_id" => new ObjectId($uuid)]);
                if ($result->getDeletedCount() === 1) {
                    echo json_encode(["code" => 200, "body" => $result, "message" => "Deleted successfuly!"]);
                } else {
                    echo json_encode(["code" => 200, "body" => $result, "message" => "Not found!"]);
                }
                exit;
            } catch (Exception $e) {
                printf($e->getMessage());
            }
        }
    }