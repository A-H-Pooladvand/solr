<?php

namespace App\Http\Controllers\Solr\Admin;

use App\Http\Curl\SolrTest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SolrController extends Controller
{
    protected $solr;

    public function __construct(SolrTest $solr)
    {
        $this->solr = $solr;
    }

    public function index()
    {
        return $this->solr->index();
    }
}
