<?php

    const CHARACTER_WEIGHT = 4;
    const DIGIT_WEIGHT = 4;
    const UPPERCASE_WEIGHT = 2;
    const LOWERCASE_WEIGHT = 2;
    const MIN_AMOUNT_OF_DUPLICATES = 2;
 
    function getGETParameter(string $key): ?string
    {
        return $_GET[$key];
    }

    function getPasswordStrength(?string $password): int
    {
        $strength = 0;
        if (empty($password))
        {
            return $strength;
        }

        $amountOfSymbols = iconv_strlen($password);
        echo "Количество символов: ", $amountOfSymbols, "\n";

        $strength = $amountOfSymbols * CHARACTER_WEIGHT;

        $strength += preg_match_all("/\d/", $password) * DIGIT_WEIGHT;

        $uppercase = preg_match_all("/[A-ZА-Я]/u", $password);
        echo "Количество символов в верхнем регистре: ", $uppercase, "\n";
        if ($uppercase)
        {
            $strength = $strength + ($amountOfSymbols - $uppercase) * UPPERCASE_WEIGHT;
        }

        $lowercase = preg_match_all("/[a-zа-я]/u", $password);
        echo "Количество символов в нижнем регистре: ", $lowercase, "\n";
        if ($lowercase)
        {
            $strength = $strength + ($amountOfSymbols - $lowercase) * LOWERCASE_WEIGHT;
        }

        $strength = ctype_alpha($password) ? ($strength - $amountOfSymbols) : $strength;

        $strength = ctype_digit($password) ? ($strength - $amountOfSymbols) : $strength;

        $strength = $strength - getDuplicatesCount($password);
 
        return $strength;
    } 

    function getDuplicatesCount(?string $password): ?int
    {
        foreach (count_chars($password, 1) as $val)
        {
            if ($val >= MIN_AMOUNT_OF_DUPLICATES)
            {
                $duplicate = $val;
            }
        }
        return $duplicate;
    }

    header('Content-Type: text/plane');

    $password = getGETParameter('password');

    echo ((iconv_strlen($password) === 0) ? 'Нет password!' : getPasswordStrength($password));    