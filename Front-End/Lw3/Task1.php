<?php
header("Content-Type: text/plain");  // тип файла

if (!isset($_GET['text']))  // проверка наличия переменной в queary string
{
    die("Set text");  // если нет, то завершить прогу
}

$textString = trim($_GET['text']);  // убираем начальные и конечные пробелы
$resultString = "";
$spaceFlag = false;
$len = strlen($textString);

for ($i = 0; $i < $len; $i++)  
{
    $char = $textString[$i];  // проверка на наличие пробелов
    if ($char != " ")  
    {
        if ($spaceFlag)  
        {
            $resultString = "$resultString "; 
        }
        $resultString = "$resultString$char";  
        $spaceFlag = false;
    }
    else 
    {
        $spaceFlag = true;
    }
}

echo $resultString;