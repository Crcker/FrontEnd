<?php
 
    function getGETParameter(string $key): ?string
    {
        return $_GET[$key] ?? null;
    }

    function validateIdentifier(?string $identifier): void
    {
        if (is_null($identifier))
        {
            throw new Exception('Нет идентификатора "identifier"!');
        }

        if (!$identifier)
        {
            throw new Exception('Пустой идентификатор "identifier"!');
        }

        if (!ctype_alpha($identifier[0]))
        {
            throw new Exception('Первый символ не является латинской буквой');
        }

        if (!ctype_alnum($identifier))
        {
            throw new Exception('Строка не является буквенно-цифровой');
        }
    }

    header("Content-Type: text/plain");

    $identifier = getGETParameter('identifier');
    try 
    {
        validateIdentifier($identifier);
        echo "yes";
    }
    catch (Exception $e) 
    {
        echo "No" . PHP_EOL . $e->getMessage();
    }