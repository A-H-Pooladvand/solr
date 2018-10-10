<?php

namespace App\Http\Helper;


class Curl
{
    /**
     * Get a response from given url.
     *
     * @param string $url
     * @param string $format
     * @return mixed
     */
    public static function get(string $url, string $format)
    {
        // create curl resource
        $ch = curl_init();

        // set url
        curl_setopt($ch, CURLOPT_URL, $url);

        //return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // $output contains the output string
        $output = curl_exec($ch);

        // close curl resource to free up system resources
        curl_close($ch);

        if ($format === 'json') {
            return json_decode($output, true);
        }

        return $output;
    }
}
