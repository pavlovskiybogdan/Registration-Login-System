<?php

namespace Framework\Database;

use Framework\Exceptions\QueryException;
use Framework\Component;

/**
 * Class Builder
 * @package Framework\Database
 */
class Builder extends Component
{
    /**
     * Connection object
     */
    private DB $db;

    /**
     * Active query table
     */
    private string $table;

    /**
     * Query parameters
     */
    private array $values = [];

    /**
     * Query columns
     */
    private array $columns = [];

    public function __construct()
    {
        $this->db = new DB();
    }

    /**
     * @param string $name
     * @return static
     */
    public static function table(string $name): self
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
    public function insert(array $values = [])
    {
        if (!empty($values)) {
            foreach ($values as $key => $value) {
                array_push($this->values, $value);
                array_push($this->columns, $key);
            }

            $splittedColumns = implode(', ', $this->columns);
            $columns = implode(', ', array_map(fn($column): string => ':' . $column, $this->columns));

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
    public function update(array $values = [])
    {
        if (!empty($values)) {
            $splittedValues = implode(', ', array_map(
                fn($value, $key): string => $key . '="' . $value . '"', array_values($values), array_keys($values)
            ));

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
        $result = array_map(fn($res) => $this->associate($res), $queryResult);

        return count($result) === 1 ? $result[0] : $result;
    }
}