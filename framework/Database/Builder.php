<?php

namespace Framework\Database;

use Framework\Exceptions\QueryException;
use Framework\Component;

class Builder extends Component
{
    /**
     * Connection object
     * @var DB
     */
    private $db;

    /**
     * Active table
     * @var string
     */
    private $table;

    /**
     * Query parameters
     * @var array
     */
    private $values = [];

    /**
     * Query columns
     * @var array
     */
    private $columns = [];

    /**
     * Builder constructor
     */
    public function __construct()
    {
        $this->db = new DB();
    }

    /**
     * @param string $name
     * @return static
     */
    public static function table(string $name) : self
    {
        $self = new static();

        $self->table = $name;

        return $self;
    }

    /**
     * Insert record
     * @param array $values
     * @return array|null
     * @throws QueryException
     */
    public function insert($values = [])
    {
        if (!empty($values)) {
            foreach ($values as $key => $value) {
                array_push($this->values, $value);
                array_push($this->columns, $key);
            }

            $splittedColumns = implode(', ', $this->columns);

            // Safe binding
            $columns = implode(', ', array_map(function($column) {
                return ':' . $column;
            }, $this->columns));

            return $this->db->query(
                "INSERT INTO $this->table ($splittedColumns) VALUES ($columns)", $values
            );
        }

        throw new QueryException();
    }

    /**
     * Update record
     * @param array $values
     * @return array|null
     * @throws QueryException
     */
    public function update($values = [])
    {
        if (!empty($values)) {
            $splittedValues = array_map(function($value, $key) {
                return $key . '="' . $value . '"';
            }, array_values($values), array_keys($values));

            $splittedValues = implode(', ', $splittedValues);

           return $this->db->query("UPDATE $this->table SET $splittedValues WHERE id = :id",[
               'id' => $this->id
            ]);
        }

        throw new QueryException();
    }

    /**
     * Select query with where clause
     * @param string $column
     * @param string $value
     * @return $this|array
     * @throws QueryException
     */
    protected function where(string $column, string $value)
    {
        if (!empty($column) && !empty($value)) {
            // safe binding (by : delimiter)
            $query = $this->db->query("SELECT * FROM $this->table WHERE $column = :$column", [
                $column => $value
            ]);

            return $this->result($query);
        }

        throw new QueryException();
    }

    /**
     * Format the result of query
     * @param array $queryResult
     * @return $this|array
     */
    private function result(array $queryResult)
    {
        $result = [];

        foreach ($queryResult as $res) {
            $result[] = $this->associate($res);
        }

        return count($result) === 1 ? $result[0] : $result;
    }
}