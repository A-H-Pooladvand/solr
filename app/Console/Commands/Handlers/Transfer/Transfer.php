<?php

namespace App\Console\Commands\Handlers\Transfer;

class Transfer
{
    public function handle()
    {
        echo $this->curl("http://127.0.0.1:7000/solr/#/");
    }
}
