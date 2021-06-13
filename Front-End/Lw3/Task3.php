<?php

    const CHARACTER_WEIGHT = 4;
    const DIGIT_WEIGHT = 4;
    const UPPERCASE_WEIGHT = 2;
    const LOWERCASE_WEIGHT = 2;
    const MinVal = 2;
 
    function getGETParameter(string $key): ?string
    {
        return $_GET[$key] ?? null;
    }

    function getPasswordStrength(?string $password): ?int
    {
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

        $strength = $strength - CountDuplicates($password);
 
        

        if ($strength == 0)
        {
            return $strength;
        }

        return $strength;
    } 

    function CountDuplicates(?string $password): ?int
    {
        foreach (count_chars($password, 1) as $val)
        {
            if ($val >= MinVal)
            {
                $duplicate = $val;
            }
        }
        return $duplicate;
    }

    header('Content-Type: text/plane');

    $password = getGETParameter('password');

    $passwordStrength = getPasswordStrength($password);
    if (!empty($passwordStrength))
    {
        echo $passwordStrength;
    }
    
    if (is_null($password))
    {
        echo getPasswordStrength($password) ?: 'Нет идентификатора password!';

    }
    elseif (iconv_strlen ($password) === 0)
    {
        echo getPasswordStrength($password) ?: 'Пустой идентификатор "password"!';

    }
    
