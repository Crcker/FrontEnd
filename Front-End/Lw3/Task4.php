<?php

    const DIR = "./data/";
    const TXT = '.txt';
    const DIVIDER = ':';
    
    function getGETParameter(string $key)
    {
        return $_GET[$key] ?? null;
    }

    function saveUserDataByEmail(array $userData)
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
            if (!getDataFromFile($filePath, $currentData))
            {
                $error = 'Error! Internal server error!';
                exit ($error);
            }

            $newData = [];
            foreach ($userData as $key => $value)
            {
                $newData[$key] = $value ?? $currentData[$key];
            }

            if (!writeDataToFile($filePath, $newData))
            {
                $error = 'Error! Internal server error!';
                exit ($error);
            }
        }
        elseif(!writeDataToFile($filePath, $userData))
        {
            
            $error = 'Error! Internal server error!';
            exit ($error);
        }
    
        return null;
    }

    function getDataFromFile(string $filePath, array $data = [])
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

    function writeDataToFile(string $filePath, array $data)
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