<?php

namespace App\Http\Helper;

class SolrHelper
{
    public $url;

    public $port;

    public $path;

    public $take;

    public $connection;

    public $table;

    public $format;

    protected $query;

    protected $queryString;

    protected $select;

    protected $searchKeywords;

    public function __construct()
    {
        $this->setUrl();
        $this->setPort();
        $this->setPath();
        $this->setConnection();
        $this->setQuery();
    }

    protected function setConnection()
    {
        $this->connection = $this->getUrl() . ':' . $this->getPort() . '/' . $this->getPath() . '/';

        return $this;
    }

    protected function getConnection()
    {
        return $this->connection;
    }

    protected function wildcard()
    {
        return '*:*';
    }

    protected function curlQuery(string $format = 'json')
    {
        $this->setFormat($format);

        $this->setQueryString();

        return Curl::get($this->getQueryString(), $format);
    }

    protected function normalizeSpaces(string $string)
    {
        return preg_replace('/\s/', '%2B', $string);
    }

    protected function setFormat(string $format = 'json')
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

    private function setUrl()
    {
        $this->url = 'http://' . config('solr.config.url');

        return $this;
    }

    private function getUrl()
    {
        return $this->url;
    }

    private function setPort()
    {
        $this->port = config('solr.config.port');

        return $this;
    }

    private function getPort()
    {
        return $this->port;
    }

    private function setPath()
    {
        $this->path = config('solr.config.path');

        return $this;
    }

    private function getPath()
    {
        return $this->path;
    }

    private function setQuery()
    {
        $this->query = 'q=';

        return $this;
    }

    private function getQuery()
    {
        return $this->searchKeywords === null ? $this->query . $this->wildcard() : $this->query;
    }

    private function toJson()
    {
        $this->format .= '&wt=json';

        return $this;
    }

    private function toCSV()
    {
        $this->format .= '&wt=json';

        return $this;
    }

    private function toPhp()
    {
        $this->format .= '&wt=php';

        return $this;
    }

    protected function setQueryString()
    {
        $this->queryString = $this->getConnection() . $this->getTable() . $this->getSelect() . $this->getQuery() . $this->getTake() . $this->getFormat();
    }

    protected function getQueryString()
    {
        return $this->queryString;
    }

    protected function getTable()
    {
        return $this->table;
    }

    protected function getTake()
    {
        return $this->take;
    }

    protected function getSelect()
    {
        return $this->select;
    }

    protected function getFormat()
    {
        return $this->format;
    }
}
