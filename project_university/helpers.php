<?php

$app_url = 'http://localhost/project-university/';


function url($url)
{
    global $app_url;
    $domain = trim($app_url, '/ ');
    $url = $domain . '/' . trim($url, '/ ');
    return $url;
}
