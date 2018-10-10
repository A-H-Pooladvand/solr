<?php

namespace App\Http\Controllers\Main\Admin;

use App\Http\Helper\Solr;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    protected $solr;

    public function __construct()
    {
        $this->solr = new Solr;
    }

    public function index()
    {
//        return Curl::get2('http://php_read:KZp7qhN8$qphp_read@185.81.40.203:8983/solr/twitter/select?df=id&fl=id&fq=created_at_dt:[2018-06-09T00:00:00Z%20TO%202018-10-09T00:00:00Z]&indent=on&q=+text_txt:("کتاب")&rows=50&wt=csv');

        return $this->solr->table('twitter')->where('Game Thrones')->get();
    }
}
