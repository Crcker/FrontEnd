<?php

    const DIR = "./data/";
    const TXT = '.txt';
    const DIVIDER = ':';

    function GetGETParameter(string $key)
    {
        return $_GET[$key] ?? null;
    }

    function PrintDataFromFileByEmail(?string $email)
    {
        if (!$email)
        {
            $error = 'Error! Email required field!';
            exit ($error);
        }
        $filePath = DIR . $email . TXT;
        if (!is_readable($filePath))
        {
            $error = 'Error! Couldn\'t find a profile with this email address!';
            exit ($error);
        }
        
        $data = [];
        if (!GetDataFromFile($filePath, $data))
        {
            $error = 'Error! Internal server error!';
            exit ($error);
        }

        printData($data);
        
        return null;
    }

    function GetDataFromFile(string $filePath, array &$data = [])
    {
        $fileDescriptor = fopen($filePath, 'r');
        if (!$fileDescriptor)
        {
            return null;
        }

        while ($fileLine = fgets($fileDescriptor))
        {
            $splitData = explode(DIVIDER, $fileLine, 2);
            $key = trim($splitData[0]);
            $value = trim($splitData[1]);
            $data[$key] = $value;
        }

        return $filePath;
    }

    function printData(array $data): void
    {
        echo 'First Name: ' . ($data['firstName'] ?? ' ') . PHP_EOL;
        echo 'Last Name: ' . ($data['lastName'] ?? ' ') . PHP_EOL;
        echo 'Email: ' . ($data['email'] ?? ' ') . PHP_EOL;
        echo 'Age: ' . ($data['age'] ?? ' ') . PHP_EOL;
    }

    header('Content-Type: text/plane');


    $email = GetGETParameter('email');
    $error = '';

    if (!PrintDataFromFileByEmail($email, $error))
    {
        echo $error;
    }