<?php
    class General {
        public function validate_fields($model, $field_list = []) {
            $requiredModel = $this->requiredModelAsArray($model);
            $allModel = $this->allModelAsArray($model);
            $keys_as_array = array_keys((array) $field_list);
            $isMissing = array_values(array_filter($requiredModel, function($field) use ($keys_as_array) { return !in_array($field, $keys_as_array); }));
            $isUndefined = array_values(array_filter($keys_as_array, function($field) use ($allModel) { return !in_array($field, $allModel); }));
            if ($isMissing) {
                if (count($isMissing) > 1) {
                    echo json_encode(["code" => 400, "message" => "The fields [".implode(", ", $isMissing)."] are missing!"]);
                } else {
                    echo json_encode(["code" => 400, "message" => "The field [".$isMissing[0]."] is missing!"]);
                }
                exit;
            }
            if ($isUndefined) {

                if (count($isUndefined) > 1) {
                    echo json_encode(["code" => 400, "message" => "The fields [".implode(", ", $isUndefined)."] are undefined!"]);
                } else {
                    echo json_encode(["code" => 400, "message" => "The field [".$isUndefined[0]."] is undefined!"]);
                }
                exit;
            }
        }

        private function requiredModelAsArray($model) {
            $filtered = array_filter($model, function($item) {
                return isset($item['required']) && $item['required'] == 1;
            });
            $fieldNames = array_map(function($item) {
                return $item['field'];
            }, $filtered);
            return $fieldNames;
        }

        private function allModelAsArray($model) {
            $filtered = array_filter($model, function($item) {
                return isset($item['required']) && $item['required'] == 1;
            });
            $fieldNames = array_map(function($item) {
                return $item['field'];
            }, $filtered);
            return $fieldNames;
        }

        public function uuidArrayMapper($documentsArray) {
            return array_map(function($item) {
                $item["uuid"] = (string) $item["_id"]; 
                unset($item["_id"]);
                return $item;
            }, $documentsArray);
        }

        public function uuidObjectMapper($document) {
            $document["uuid"] = (string) $document["_id"]; 
            unset($document["_id"]);
            return $document;
        }
    }