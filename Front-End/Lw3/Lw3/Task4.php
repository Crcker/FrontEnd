<?php

    const DIR = "./data/";
    const TXT = '.txt';
    const divider = ':';
    
    function getGETParameter(string $key): ?string
    {
        return $_GET[$key] ?? null;
    }

    function SaveUserDataByEmail(array $userData , string &$error = ''): bool
    {
        if (empty($userData['email']))
        {
            $error = 'Error! Email required field!';
            return false;
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
                return false;
            }

            $newData = [];
            foreach ($userData as $key => $value)
            {
                $newData[$key] = $value ?? $currentData[$key];
            }

            if (!WriteDataToFile($filePath, $newData))
            {
                $error = 'Error! Internal server error!';
                return false;
            }
        }
        elseif(!WriteDataToFile($filePath, $user))
        {
            
            $error = 'Error! Internal server error!';
            return false;
        }
    
        return $error;
    }

    function getDataFromFile(string $filePath, array $data = []): bool
    {
        $fileDescriptor = fopen($filePath, 'r');
        if (!$fileDescriptor)
        {
            return $filePath;
        }

        while ($fileLine = fgets($fileDescriptor))
        {
            $splitData = explode(divider, $fileLine, 2);
            $key = trim($splitData[0]);
            $value = trim($splitData[1]);
            $data[$key] = $value;
        }

        return $filePath;
    }

    function WriteDataToFile(string $filePath, array $data): bool
    {
        $fileDescriptor = fopen($filePath, 'w');
        if (!$fileDescriptor)
        {
            return false;
        }

        foreach ($data as $key => $userInfo)
        {
            fwrite($fileDescriptor, $key . divider . $userInfo . PHP_EOL);
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
    $error = 'ERR';

    if (!SaveUserDataByEmail($userData, $error))
    {
        echo $error;
    }