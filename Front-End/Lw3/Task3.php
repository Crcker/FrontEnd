<?php

    const CHARACTER_WEIGHT = 4;
    const DIGIT_WEIGHT = 4;
    const UPPERCASE_WEIGHT = 2;
    const LOWERCASE_WEIGHT = 2;

    function getGETParameter(string $key): ?string
    {
        return $_GET[$key] ?? null;
    }

    function getPasswordStrength(?string $password): ?int
    {
        if (is_null($password))
        {
            echo 'Нет идентификатора password!';
            return null;
        }

        if (iconv_strlen ($password) === 0)
        {
            echo 'Пустой идентификатор "password"!';
            return null;
        }

        $strength = 0;
        $strength = $strength + iconv_strlen ($password) * CHARACTER_WEIGHT;

        $strength = $strength + (preg_match_all("/\d/", $password)) * DIGIT_WEIGHT;

        $uppercase = preg_match_all("/[A-ZА-Я]/u", $password);
        if ($uppercase !== 0)
        {
            $strength = $strength + (iconv_strlen ($password) - $uppercase) * UPPERCASE_WEIGHT;
        }

        $lowercase = preg_match_all("/[a-zа-я]/u", $password);
        if ($lowercase !== 0)
        {
            $strength = $strength + (iconv_strlen ($password) - $lowercase) * LOWERCASE_WEIGHT;
        }

        $strength = ctype_alpha($password) ? ($strength - iconv_strlen ($password)) : $strength;

        $strength = ctype_digit($password) ? ($strength - iconv_strlen ($password)) : $strength;

        foreach (count_chars($password, 1) as $val)
        {
            if ($val >= 2)
            {
                $strength = $strength - $val;
            }
        }

        return $strength;
    }    

    header('Content-Type: text/plane');

    $password = getGETParameter('password');

    $passwordStrength = getPasswordStrength($password);
    if (!is_null($passwordStrength))
    {
        echo $passwordStrength;
    }