<?php

    const CHARACTER_WEIGHT = 4;
    const DIGIT_WEIGHT = 4;
    const UPPERCASE_WEIGHT = 2;
    const LOWERCASE_WEIGHT = 2;
    const MINVALUE = 2;
 
    function GetGETParameter(string $key)
    {
        return $_GET[$key];
    }

    function GetPasswordStrength(?string $password)
    {
        if (empty($password))
        {
            return $strength;
        }
        $strength = 0;
        $amount = $amount + iconv_strlen ($password);
        $strength = $strength + $amount * CHARACTER_WEIGHT;

        $strength = $strength + (preg_match_all("/\d/", $password)) * DIGIT_WEIGHT;

        $uppercase = preg_match_all("/[A-ZА-Я]/u", $password);
        if ($uppercase)
        {
            $strength = $strength + ($amount - $uppercase) * UPPERCASE_WEIGHT;
        }

        $lowercase = preg_match_all("/[a-zа-я]/u", $password);
        if ($lowercase)
        {
            $strength = $strength + ($amount - $lowercase) * LOWERCASE_WEIGHT;
        }

        $strength = ctype_alpha($password) ? ($strength - $amount) : $strength;

        $strength = ctype_digit($password) ? ($strength - $amount) : $strength;

        $strength = $strength - GetCountDuplicates($password);
 
        return $strength;
    } 

    function GetCountDuplicates(?string $password)
    {
        foreach (count_chars($password, 1) as $val)
        {
            if ($val >= MINVALUE)
            {
                $duplicate = $val;
            }
        }
        return $duplicate;
    }

    header('Content-Type: text/plane');

    $password = GetGETParameter('password');

    echo ((iconv_strlen ($password) === 0) ? (is_null ($password) ? 'Нет идентификатора password!' : 'Пустой идентификатор "password"!') : GetPasswordStrength($password));    