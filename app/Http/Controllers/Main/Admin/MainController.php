<?php

namespace App\Http\Controllers\Main\Admin;

use App\Http\Src\Curl\Curl;
use App\Http\Src\Solr\Solr;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    protected $solr;

    public function __construct(Solr $solr)
    {
        $this->solr = $solr;
    }

    public function index()
    {
        return $this->solr->document()->insert([
            'id' => '1',
            'title' => 'Amirhossein'
        ]);
    }

    public function trash()
    {
        $url = urlencode('روحانی');
        $results =  Curl::get('http://185.81.40.203:8983/solr/twitter/select?df=id&fl=id&fq=created_at_dt:[2018-06-09T00:00:00Z%20TO%202018-10-09T00:00:00Z]&indent=on&q=+text_txt:(' . $url . ')&rows=10&wt=json');

        $results = collect($results);

        $results = $results->groupBy(function ($item) {
            return $item['id'];
        })->toArray();

        return $results;
    }
}
