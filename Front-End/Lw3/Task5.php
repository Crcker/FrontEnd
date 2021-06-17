<?php

    const DIR = "./data/";
    const FILE_EXTENSION = '.txt';
    const DIVIDER = ':';

    function getGETParameter(string $key): ?string
    {
        return $_GET[$key] ?? null;
    }

    function printDataFromFileByEmail(?string $email): ?string
    {
        if (!$email)
        {
            $error = 'Error! Email required field!';
            echo($error);
            return null;
        }
        $filePath = DIR . $email . FILE_EXTENSION;
        if (!is_readable($filePath))
        {
            $error = 'Error! Couldn\'t find a profile with this email address!';
            echo($error);
            return null;
        }
        
        $data = [];
        if (!getDataFromFile($filePath, $data))
        {
            $error = 'Error! Internal server error!';
            echo($error);
            return null;
        }

        printData($data);
        
        return null;
    }

    function getDataFromFile(string $filePath, array &$data = []): ?array
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

        return $data;
    }

    function printData(array $data): void
    {
        echo 'First Name: ' . ($data['firstName'] ?? ' ') . PHP_EOL;
        echo 'Last Name: ' . ($data['lastName'] ?? ' ') . PHP_EOL;
        echo 'Email: ' . ($data['email'] ?? ' ') . PHP_EOL;
        echo 'Age: ' . ($data['age'] ?? ' ') . PHP_EOL;
    }

    header('Content-Type: text/plane');


    $email = getGETParameter('email');
    $error = '';

    if (!printDataFromFileByEmail($email, $error))
    {
        echo $error;
    }
