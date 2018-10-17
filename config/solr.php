<?php
$solrLocation = '/home/reza/Desktop/solr-7.5.0/';
$solrPath = 'server/solr/';
$solrConfigFolder = 'configsets/_default';

return [
    'config' => [
        'url' => '127.0.0.1',
        'port' => '8983',
        'path' => 'solr',
        'username' => 'admin',
        'password' => 'admin',
        'solrLocation' => $solrLocation,
        'solrPath' => $solrLocation . $solrPath,
        'solrConfigFolder' => $solrLocation . $solrPath . $solrConfigFolder,
    ]
];
