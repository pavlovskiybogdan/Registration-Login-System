<?php

namespace Framework\Database;

use PDO;
use PDOStatement;

/**
 * Class DB
 * @package Framework\Database
 */
class DB
{
    /**
     * PDO active object
     */
    private PDO $pdo;

    /**
     * Is active connection
     */
    private bool $isConnected;

    /**
     * Current query statement
     */
    private PDOStatement $statement;

    /**
     * Query parameters
     */
    private array $parameters = [];

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $dsnString = 'mysql:dbname='. $_ENV['DB_DATABASE'] .';host=' . $_ENV['DB_HOST'];

        try {
            $this->pdo = new PDO($dsnString, $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $_ENV['DB_ENCODE']
            ]);

            $this->isConnected = true;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    /**
     * @param string $query
     * @param array $parameters
     */
    private function init(string $query, array $parameters = [])
    {
        if(!$this->isConnected) {
            $this->connect();
        }

        try {
            $this->statement = $this->pdo->prepare($query);

            $this->bind($parameters);

            if(!empty($this->parameters)) {
                foreach ($this->parameters as $param => $value) {
                    if(is_int($value[1])) {
                        $type = PDO::PARAM_INT;
                    } elseif (is_bool($value[1])) {
                        $type = PDO::PARAM_BOOL;
                    } elseif (is_null($value[1])) {
                        $type = PDO::PARAM_NULL;
                    } else {
                        $type = PDO::PARAM_STR;
                    }

                    $this->statement->bindValue($value[0], $value[1], $type);
                }
            }

            $this->statement->execute();

        } catch (\PDOException $e) {
            exit($e->getMessage());
        }

        $this->parameters = [];
    }

    /**
     * @param array $parameters
     */
    private function bind(array $parameters)
    {
        if(!empty($parameters) && is_array($parameters)) {
            $columns = array_keys($parameters);

            foreach ($columns as $i => &$column) {
                $this->parameters[count($this->parameters)] = [
                    ':' . $column,
                    $parameters[$column]
                ];
            }
        }
    }

    /**
     * @param string $query
     * @param array $parameters
     * @param int $mode
     * @return array|int|null
     */
    public function query(
        string $query,
        array $parameters = [],
        $mode = PDO::FETCH_ASSOC
    )
    {
        $query = trim(str_replace('\r', '', $query));

        $this->init($query, $parameters);
        $rawStatement = explode( ' ', preg_replace("/\s+|\t+|\n+/", " ", $query));
        $statement = strtolower($rawStatement[0]);

        if($statement === 'select' || $statement = 'show') {
            return $this->statement->fetchAll($mode);
        } elseif ($statement === 'insert' || $statement === 'update' || $statement === 'delete') {
            return $this->statement->rowCount();
        } else {
            return null;
        }
    }
}