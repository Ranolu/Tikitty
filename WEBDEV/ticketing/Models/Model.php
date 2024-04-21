<?php
    class Model {
        protected $table;
        protected $connection;
    
        public function __construct($conn) {
            $this->connection = $conn;
        }
    
        public function all() {
            $query = "SELECT * FROM {$this->table}";
            return $this->connection->query($query)->fetch_all(MYSQLI_ASSOC);
        }

        public function selectLimitedAndOrdered($limit, $orderByColumn, $orderByDirection) {
            $query = "SELECT * FROM {$this->table} ORDER BY $orderByColumn $orderByDirection LIMIT $limit";
            return $this->connection->query($query)->fetch_all(MYSQLI_ASSOC);
        }

        public function selectWhereLimitedAndOrdered($columnData, $limit, $orderByColumn, $orderByDirection) {
            $whereClause = '';
            foreach ($columnData as $columnName => $columnValues) {
                if (is_array($columnValues)) {
                    $escapedColumnName = $this->connection->real_escape_string($columnName);
                    $orConditions = '';
                    foreach ($columnValues as $columnValue) {
                        $escapedColumnValue = $this->connection->real_escape_string($columnValue);
                        $orConditions .= "$escapedColumnName = '$escapedColumnValue' OR ";
                    }
                    $orConditions = rtrim($orConditions, ' OR ');
                    $whereClause .= "($orConditions) AND ";
                } else {
                    $escapedColumnName = $this->connection->real_escape_string($columnName);
                    $escapedColumnValue = $this->connection->real_escape_string($columnValues);
                    $whereClause .= "$escapedColumnName = '$escapedColumnValue' AND ";
                }
            }
            $whereClause = rtrim($whereClause, ' AND ');
            
            $query = "SELECT * FROM {$this->table} WHERE $whereClause ORDER BY $orderByColumn $orderByDirection LIMIT $limit";
        
            return $this->connection->query($query)->fetch_all(MYSQLI_ASSOC);
        }
    
        public function findByColumn($columnData) {
            $params = [];
            $conditions = [];
        
            foreach ($columnData as $columnName => $columnValue) {
                $columnName = $this->connection->real_escape_string($columnName);
                $conditions[] = "BINARY {$columnName} = ?";
                $params[] = $columnValue;
            }
        
            $whereClause = implode(' AND ', $conditions);
            $query = "SELECT * FROM {$this->table} WHERE {$whereClause}";
            $statement = $this->connection->prepare($query);
            
            $types = str_repeat('s', count($params)); 
            $statement->bind_param($types, ...$params);
        
            $statement->execute();
            $result = $statement->get_result();
        
            return $result->fetch_assoc();
        }

        public function findAllByColumn($columnData, $limit = null) {
            $params = [];
            $conditions = [];
        
            foreach ($columnData as $columnName => $columnValue) {
                $columnName = $this->connection->real_escape_string($columnName);
                $conditions[] = "BINARY {$columnName} = ?";
                $params[] = $columnValue;
            }
        
            $whereClause = implode(' AND ', $conditions);
            $query = "SELECT * FROM {$this->table} WHERE {$whereClause}";
        
            if ($limit !== null) {
                $query .= " LIMIT ?";
                $params[] = $limit;
            }
        
            $statement = $this->connection->prepare($query);
        
            $types = str_repeat('s', count($params));
            $statement->bind_param($types, ...$params);
        
            $statement->execute();
            $result = $statement->get_result();
        
            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        
            return $rows;
        }

        public function searchAllByColumn($columnData, $limit) {
            $params = [];
            $conditions = [];
        
            foreach ($columnData as $columnName => $columnValue) {
                $columnName = $this->connection->real_escape_string($columnName);
                $conditions[] = "{$columnName} LIKE ?";
                $params[] = "%" . $columnValue . "%";
            }
        
            $whereClause = implode(' AND ', $conditions);
            $query = "SELECT * FROM {$this->table} WHERE {$whereClause}";
            
            if ($limit !== null) {
                $query .= " LIMIT ?";
                $params[] = $limit;
            }
        
            $statement = $this->connection->prepare($query);
        
            $types = str_repeat('s', count($params));
            $statement->bind_param($types, ...$params);
        
            $statement->execute();
            $result = $statement->get_result();
        
            $rows = [];
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        
            return $rows;
        }
    
        public function create($data) {
            $keys = implode(', ', array_keys($data));
            $placeholders = rtrim(str_repeat('?, ', count($data)), ', ');
    
            $query = "INSERT INTO {$this->table} ({$keys}) VALUES ({$placeholders})";
            $statement = $this->connection->prepare($query);
    
            $types = str_repeat('s', count($data)); 
            $values = array_values($data);
            $statement->bind_param($types, ...$values);
            
            return $statement->execute();
        }
    
        public function update($columnData, $data) {
            $idColumnName = key($columnData);
            $id = $columnData[$idColumnName];
        
            $set = implode(', ', array_map(function($key) { return $key . ' = ?'; }, array_keys($data)));
            $query = "UPDATE {$this->table} SET {$set} WHERE {$idColumnName} = ?";
            $statement = $this->connection->prepare($query);
            
            $values = array_values($data);
            $values[] = $id;
        
            $types = str_repeat('s', count($data)) . 'i'; 
            $statement->bind_param($types, ...$values);
        
            return $statement->execute();
        }
    
        public function delete($columnData) {
            $idColumnName = key($columnData);
            $id = $columnData[$idColumnName];
            $query = "DELETE FROM {$this->table} WHERE $idColumnName = ?";
            $statement = $this->connection->prepare($query);
            $statement->bind_param('i', $id);
            return $statement->execute();
        }
    }    
?>