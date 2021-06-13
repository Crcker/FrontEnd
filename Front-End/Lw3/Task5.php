<?php

    const DIR = "./data/";

    function getGETParameter(string $key): ?string
    {
        return $_GET[$key] ?? null;
    }

    function printDataFromFileByEmail(?string $email, string &$error): bool
    {
        if ($email)
        {
            $filePath = DIR . $email . '.txt';
            if (is_readable($filePath))
            {
                $data = [];
                if (!getDataFromFile($filePath, $data))
                {
                    $error = 'Error! Internal server error!';
                    return false;
                }

                printData($data);
            }
            else
            {
                $error = 'Error! Couldn\'t find a profile with this email address!';
                return false;
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