<?php

namespace App\Http\Src\Solr;

use App;
use App\Http\Src\Curl\Curl;

class Solr
{
    public $config;

    public $index;

    public $curl;

    public $builder;

    public function __construct()
    {
        $this->index = App::make(Index::class);

        $this->curl = App::make(Curl::class);

        $this->builder = App::make(SolrBuilder::class);

        $this->select();

        $this->take();
    }

    public function index()
    {
        return new Index;
    }

    public function document()
    {
        return new Document($this->builder);
    }

    public function commit()
    {
        return $this->curl->get($this->builder->getTableConnection() . 'update?commit=true');
    }

    public function all(string $format = 'json')
    {
        $this->where($this->builder->wildcard());

        return $this->builder->curlQuery($format);
    }

    public function get(string $format = 'json')
    {
        return $this->builder->curlQuery($format);
    }

    public function table(string $tableName)
    {
        $this->builder->setTable($tableName);

        return $this;
    }

    public function where($queries)
    {
        $this->normalizeWhereClause($queries);

        $query = $this->builder->normalizeSpaces($this->builder->searchKeywords);

        $this->builder->query .= $query;

        return $this;
    }

    public function isAssoc(array $array)
    {
        if (array() === $array) return false;
        return array_keys($array) !== range(0, count($array) - 1);
    }

    public function select(string $fields = null)
    {
        if (isset($fields)) {
            $fields = 'fl=' . $fields . '&';
        }

        $this->builder->select = '/select?' . $fields;

        return $this;
    }

    public function take(int $amount = 15)
    {
        $this->builder->take .= '&rows=' . $amount;

        return $this;
    }

    public function normalizeWhereClause($queries)
    {
        if (is_string($queries)) {
            $this->builder->searchKeywords = $queries;

            return $this;
        }

        $queryString = '';
        foreach ($queries as $key => $query) {
            $queryString .= $key . ':' . $query;
        }

        $this->builder->searchKeywords = $queryString;

        return $this;
    }
}
