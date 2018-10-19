<?php

namespace App\Http\Src\Solr;

use App\Http\Src\Curl\Curl;

class SolrBuilder
{
    public $url;

    public $port;

    public $path;

    public $take;

    public $table;

    public $query;

    public $format;

    public $select;

    public $schema;

    public $insertPath;

    public $connection;

    public $queryString;

    public $searchKeywords;

    public $tableConnection;

    public function __construct()
    {
        $this->setUrl();
        $this->setPort();
        $this->setPath();
        $this->setConnection();
        $this->setQuery();
        $this->setInsertPath();
        $this->setSchema();
    }

    public function setConnection()
    {
        $this->connection = $this->getUrl() . ':' . $this->getPort() . '/' . $this->getPath() . '/';

        return $this;
    }

    public function setTableConnection()
    {
        $this->tableConnection = $this->getConnection() . $this->getTable() . '/';
    }

    public function getTableConnection()
    {
        return $this->tableConnection;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function wildcard()
    {
        return '*:*';
    }

    public function curlQuery(string $format = 'json')
    {
        $this->setFormat($format);

        $this->setQueryString();

        return Curl::get();
    }

    public function normalizeSpaces(string $string)
    {
        return preg_replace('/\s/', '%2B', $string);
    }

    public function setFormat(string $format = 'json')
    {
        switch ($format) {
            case 'json':
                $this->toJson();
                break;
            case 'csv':
                $this->toCSV();
                break;
            case 'php':
                $this->toPhp();
                break;
        }

        return $this;
    }

    public function setUrl()
    {
        $this->url = 'http://' . config('solr.config.url');

        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setPort()
    {
        $this->port = config('solr.config.port');

        return $this;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function setPath()
    {
        $this->path = config('solr.config.path');

        return $this;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setQuery()
    {
        $this->query = 'q=';

        return $this;
    }

    public function getQuery()
    {
        return $this->searchKeywords === null ? $this->query . $this->wildcard() : $this->query;
    }

    public function toJson()
    {
        $this->format .= '&wt=json';

        return $this;
    }

    public function toCSV()
    {
        $this->format .= '&wt=json';

        return $this;
    }

    public function toPhp()
    {
        $this->format .= '&wt=php';

        return $this;
    }

    public function setQueryString()
    {
        $this->queryString = $this->getConnection() . $this->getTable() . $this->getSelect() . $this->getQuery() . $this->getTake() . $this->getFormat();
    }

    public function getQueryString()
    {
        return $this->queryString;
    }

    public function setTable(string $tableName)
    {
        $this->table = $tableName;

        $this->setTableConnection();

        return $this;
    }

    public function getTable()
    {
        return $this->table;
    }

    public function getTake()
    {
        return $this->take;
    }

    public function getSelect()
    {
        return $this->select;
    }

    public function getFormat()
    {
        return $this->format;
    }

    public function setInsertPath()
    {
//        /json/docs
        $this->insertPath = 'update';
    }

    public function getInsertPath()
    {
        return $this->getTableConnection() . $this->insertPath;
    }

    public function setSchema()
    {
        $this->schema = 'schema';
    }

    public function getSchema()
    {
        return $this->schema;
    }

    public function getSchemaConnection()
    {
        return $this->getTableConnection() . $this->getSchema();
    }
}
