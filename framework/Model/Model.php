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
     * @param array $modelData
     * @return $this
     */
    public function associate(array $modelData): self
    {
        foreach ($modelData as $key => $value) {
            $this->{$key} = trim(htmlspecialchars($value));
        }
        
        return $this;
    }
}