<?php

    function GetGETParameter(string $key)
    {
        return $_GET[$key] ?? null;
    }

    header("Content-Type: text/plain");


    $text = GetGETParameter('text');
    if ($text)
    {
        $text = trim($text);
        $text = preg_replace('/\s+/', ' ', $text);
        echo $text;
    }
    else
    {
        echo 'Parameter "text" missing';
    }