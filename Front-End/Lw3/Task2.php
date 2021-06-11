<?php
header("Content-Type: text/plain");

if (!isset($_GET['identifier']))
{
    die("set identifier");
}

$identifierString = $_GET['identifier'];

$len = strlen($identifierString);

for ($i = 0; $i < $len; $i++)
{
    if($i == 0 AND ctype_digit($identifierString[$i]))
    {
        die("no, first symbol must be letter");
    }
    if(!ctype_alnum($identifierString[$i]))
    {
        die("no, only letter and digit");
    }
}

echo "Yes";