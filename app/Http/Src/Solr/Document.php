<?php

namespace App\Http\Src\Solr;

use App;
use App\Http\Src\Curl\Curl;

class Document
{
    protected $curl;

    protected $builder;

    public function __construct(SolrBuilder $builder)
    {
        $this->curl = new Curl;

        $this->builder = $builder;
    }

    public function create(array $data)
    {
        return $this->curl->post($this->builder->getInsertPath(), $data);
    }

    public function truncate()
    {
        return $this->create([
            "delete" => ["query" => "*:*"],
        ]);
    }

    public function addField(array $fields)
    {
        foreach ($fields as $field) {
            $this->attachField($field);
            $this->attachCopyField($field);
        }

        return $this;
    }

    private function attachField(array $field)
    {
        $this->curl->post($this->builder->getSchemaConnection(), [
            "add-field" => [
                "name" => $field['name'],
                "type" => $field['type'] ?? 'text_general',
                "multiValued" => $field['multiValued'] ?? false,
                "stored" => $field['stored'] ?? true
            ]
        ]);
    }

    private function attachCopyField(array $field)
    {
        if ( ! empty($field['copy']) && $field['copy'] === false) {
            return $this;
        }

        $this->curl->post($this->builder->getSchemaConnection(), [
            "add-copy-field" => [
                "source" => '*',
                "dest" => "_text_"
            ]
        ]);

        return $this;
    }
}
