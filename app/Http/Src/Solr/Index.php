<?php

namespace App\Http\Src\Solr;

use App;
use File;
use App\Http\Src\Curl\Curl;

class Index
{
    protected $config;

    protected $curl;

    public function __construct()
    {
        $this->config = App::make(SolrConfig::class);

        $this->curl = App::make(Curl::class);
    }

    /**
     * Create an index for solr.
     *
     * @param string $index
     * @return mixed
     */
    public function create(string $index)
    {
        @mkdir($this->config->solrPath . $index);

        if ( ! File::exists($this->config->solrPath . $index . '/conf')) {
            File::copyDirectory($this->config->solrConfigFolder, $this->config->solrPath . $index);
        }

        return $this->curl->get($this->config->fullUrl . 'admin/cores?action=CREATE&name=' . $index);
    }

    /**
     * Delete an index of solr.
     *
     * @param string $index
     * @return mixed
     */
    public function delete(string $index)
    {
        return $this->curl->get($this->config->fullUrl . "admin/cores?wt=json&action=UNLOAD&core=" . $index);
    }

    /**
     * Rename an index of solr.
     *
     * @param string $oldName
     * @param string $newName
     * @return mixed
     */
    public function rename(string $oldName, string $newName)
    {
        return $this->curl->get($this->config->fullUrl . 'admin/cores?action=RENAME&core='. $oldName .'&other=' . $newName);
    }
}
