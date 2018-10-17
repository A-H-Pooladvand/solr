<?php

namespace App\Http\Src\Solr;

/**
 * @property $url
 * @property $port
 * @property $path
 * @property $username
 * @property $password
 * @property $solrLocation
 * @property $solrPath
 * @property $solrConfigFolder
 *
 * Class SolrConfig
 * @package App\Http\Curl
 */
class SolrConfig
{
    public $fullUrl;

    public function __construct()
    {
        $this->fullUrl = 'http://' . config('solr.config.url') . ':' . config('solr.config.port') . '/' . config('solr.config.path') . '/';
    }

    /**
     * Get solr config by given name.
     *
     * @param $name
     * @return \Illuminate\Config\Repository|mixed
     */
    public function __get($name)
    {
        return config('solr.config.' . $name);
    }
}
