<?php

    const DIR = "./data/";

    function getGETParameter(string $key): ?string
    {
        return $_GET[$key] ?? null;
    }

    function saveDataByEmail(array $user, string &$error = ''): bool
    {
        if (!empty($user['email']))
        {
            if (!is_dir(DIR))
            {
                mkdir(DIR);
            }

            $filePath = DIR . $user['email'] . '.txt';
            if (is_readable($filePath))
            {
                $currentData = [];
                if (!getDataFromFile($filePath, $currentData))
                {
                    $error = 'Error! Internal server error!';
                    return false;
                }

                $newData = [];
                foreach ($user as $key => $value)
                {
                    $newData[$key] = $value ?? $currentData[$key];
                }

                if (!setDataToFile($filePath, $newData))
                {
                    $error = 'Error! Internal server error!';
                    return false;
                }
            }
            else
            {
                if (!setDataToFile($filePath, $user))
                {
                    $error = 'Error! Internal server error!';
                    return false;
                }
            }
        }
        else
        {
            $error = 'Error! Email required field!';
            return false;
        }

        return true;
    }

    function getDataFromFile(string $filePath, array &$data = []): bool
    {
        $fileDescriptor = fopen($filePath, 'r');
        if (!$fileDescriptor)
        {
            return false;
        }

        while (($fileLine = fgets($fileDescriptor)) !== false)
        {
            $splitData = explode(':', $fileLine, 2);
            $key = trim($splitData[0]);
            $value = trim($splitData[1]);
            $data[$key] = $value;
        }

        return true;
    }

    function setDataToFile(string $filePath, array $data): bool
    {
        $fileDescriptor = fopen($filePath, 'w');
        if (!$fileDescriptor)
        {
            return false;
        }

        foreach ($data as $key => $userInfo)
        {
            fwrite($fileDescriptor, $key . ': ' . $userInfo . PHP_EOL);
        }
        fclose($fileDescriptor);

        return true;
    }

    header('Content-Type: text/plane');


    $user = [
        'firstName' => getGETParameter('first_name'),
        'lastName' => getGETParameter('last_name'),
        'email' => getGETParameter('email'),
        'age' => getGETParameter('age'),
    ];
    $error = 'ERR';

    if (!saveDataByEmail($user, $error))
    {
        echo $error;
    }