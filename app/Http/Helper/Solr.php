<?php

namespace App\Http\Helper;

class Solr extends SolrHelper
{
    public function __construct()
    {
        parent::__construct();

        $this->select();

        $this->take();
    }

    public function all(string $format = 'json')
    {
        $this->where($this->wildcard());

        return $this->curlQuery($format);
    }

    public function get(string $format = 'json')
    {
        return $this->curlQuery($format);
    }

    public function table(string $tableName)
    {
        $this->table = $tableName;

        return $this;
    }

    public function where($queries)
    {
        $this->normalizeWhereClause($queries);

        $query = $this->normalizeSpaces($this->searchKeywords);

        $this->query .= $query;

        return $this;
    }

    protected function isAssoc(array $array)
    {
        if (array() === $array) return false;
        return array_keys($array) !== range(0, count($array) - 1);
    }

    public function select(string $fields = null)
    {
        if (isset($fields)) {
            $fields = 'fl=' . $fields . '&';
        }

        $this->select = '/select?' . $fields;

        return $this;
    }

    public function take(int $amount = 15)
    {
        $this->take .= '&rows=' . $amount;

        return $this;
    }

    private function normalizeWhereClause($queries)
    {
        if ( is_string($queries)) {
            $this->searchKeywords = $queries;

            return $this;
        }

        $queryString = '';
        foreach ($queries as $key => $query) {
            $queryString .= $key . ':' . $query;
        }

        $this->searchKeywords = $queryString;

        return $this;
    }
}
