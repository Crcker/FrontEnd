<?php

    const DIR = "./data/";
    const TXT = '.txt';
    const DIVIDER = ':';
    
    function GetGETParameter(string $key)
    {
        return $_GET[$key] ?? null;
    }

    function SaveUserDataByEmail(array $userData)
    {
        if (empty($userData['email']))
        {
            $error = 'Error! Email required field!';
            exit ($error);
        }

        if (!is_dir(DIR))
        {
            mkdir(DIR);
        }

        $filePath = DIR . $userData['email'] . TXT;
        if (is_readable($filePath))
        {
            $currentData = [];
            if (!GetDataFromFile($filePath, $currentData))
            {
                $error = 'Error! Internal server error!';
                exit ($error);
            }

            $newData = [];
            foreach ($userData as $key => $value)
            {
                $newData[$key] = $value ?? $currentData[$key];
            }

            if (!WriteDataToFile($filePath, $newData))
            {
                $error = 'Error! Internal server error!';
                exit ($error);
            }
        }
        elseif(!WriteDataToFile($filePath, $userData))
        {
            
            $error = 'Error! Internal server error!';
            exit ($error);
        }
    
        return null;
    }

    function GetDataFromFile(string $filePath, array $data = [])
    {
        $fileDescriptor = fopen($filePath, 'r');
        if (!$fileDescriptor)
        {
            return $filePath;
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

    function WriteDataToFile(string $filePath, array $data)
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
        'firstName' => GetGETParameter('first_name'),
        'lastName' => GetGETParameter('last_name'),
        'email' => GetGETParameter('email'),
        'age' => GetGETParameter('age'),
    ];

    SaveUserDataByEmail($userData);