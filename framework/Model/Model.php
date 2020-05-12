<?php

namespace Framework\Model;

use Framework\Helpers\QueryBuilder;

/**
 * Class Model
 * @package Framework\Model
 */
class Model extends QueryBuilder
{
    /**
     * @param array $data
     * @return $this
     */
    public function associate(array $data): self
    {
        foreach ($data as $key => $value) {
            $this->{$key} = trim(htmlspecialchars($value));
        }
        
        return $this;
    }
}