<?php

namespace App\Http\Src\Solr;

use App;
use App\Http\Src\Curl\Curl;

class Document
{
    protected $curl;

    protected $solr;

    public function __construct()
    {
        $this->curl = new Curl;

        $this->solr = App::make(Solr::class);
    }

    public function insert(array $data)
    {
        return $this->solr->insert($data);

        /*$this->curl->post([
            "id" => "1",
            "title" => "Doc 1"
        ]);*/
    }
}
