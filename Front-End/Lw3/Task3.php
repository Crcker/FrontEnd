<?php
header("Content-Type: text/plain");

if (!isset($_GET['password']))
{
    die("set password");
}

$passwordString = $_GET['password'];

if (!ctype_alnum($passwordString))
{
    die ("Password can only consist of English characters or character in upper and lower case, as well as numbers");
}

//var
$passwordStrength = 0;
$digitCount = 0;
$highRegisterCount = 0;
$lowRegisterCount = 0;
$len = strlen($passwordString);

//typing
for ($i = 0; $i < $len; $i++)
{
    if(ctype_digit($passwordString[$i]))
    {
        $digitCount++;
    }
    if(ctype_upper($passwordString[$i]))
    {
        $highRegisterCount++;
    }
    if(ctype_lower($passwordString[$i]))
    {
        $lowRegisterCount++;
    }
}

$passwordStrength += $len * 4;//
$passwordStrength += $digitCount * 4;//
if($highRegisterCount != 0)
{
    $passwordStrength += ($len - $highRegisterCount) * 2;//
}
if($lowRegisterCount != 0)
{
    $passwordStrength += ($len - $lowRegisterCount) * 2;//
}

//only one type check
if($digitCount == 0)
{
    $passwordStrength -= ($highRegisterCount + $lowRegisterCount); 
}

if($lowRegisterCount == 0 && $highRegisterCount == 0)
{
    $passwordStrength -= $digitCount;
}

//check repeat
for ($i = 0; $i < $len; $i++)
{
    if(substr_count($passwordString, $passwordString[$i]) > 1)
    {
        $passwordStrength--;
    }
}

echo $passwordStrength;