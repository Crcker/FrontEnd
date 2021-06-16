<?php

    const DIR = "./data/";
    const FILE_EXTENSION = '.txt';
    const DIVIDER = ':';
    
    function getGETParameter(string $key): ?string
    {
        return $_GET[$key] ?? null;
    }

    function saveUserDataByEmail(array $userData): ?string
    {
        if (empty($userData['email']))
        {
            $error = 'Error! Email required field!';
            return $error;
        }

        if (!is_dir(DIR))
        {
            mkdir(DIR);
        }

        $filePath = DIR . $userData['email'] . FILE_EXTENSION;
        if (is_readable($filePath))
        {
            $currentData = [];
            if (!getDataFromFile($filePath, $currentData))
            {
                $error = 'Error! Internal server error!';
                return $error;
            }

            $newData = [];
            foreach ($userData as $key => $value)
            {
                $newData[$key] = $value ?? $currentData[$key];
            }

            if (!writeDataToFile($filePath, $newData))
            {
                $error = 'Error! Internal server error!';
                return $error;
            }
        }
        elseif(!writeDataToFile($filePath, $userData))
        {
            
            $error = 'Error! Internal server error!';
            return $error;
        }
    
        return null;
    }

    function getDataFromFile(string $filePath): ?array
    {
        $fileDescriptor = fopen($filePath, 'r');
        if (!$fileDescriptor)
        {
            return null;
        }

        $data = [];
        while ($fileLine = fgets($fileDescriptor))
        {
            $splitData = explode(DIVIDER, $fileLine, 2);
            $key = trim($splitData[0]);
            $value = trim($splitData[1]);
            $data[$key] = $value;
        }

        return $data;
    }

    function writeDataToFile(string $filePath, array $data): bool
    {
        $fileDescriptor = fopen($filePath, 'w');
        if (!$fileDescriptor)
        {
            return false;
        }

        foreach ($data as $key => $userInfo)
        {
            fwrite($fileDescriptor, $key . DIVIDER . $userInfo . PHP_EOL);
        }
        fclose($fileDescriptor);

        return true;
    }

    header('Content-Type: text/plane');


    $userData = [
        'firstName' => getGETParameter('first_name'),
        'lastName' => getGETParameter('last_name'),
        'email' => getGETParameter('email'),
        'age' => getGETParameter('age'),
    ];

    saveUserDataByEmail($userData);