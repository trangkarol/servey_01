<?php
    function cleanText($text, $html = true)
    {
        if (!$text) {
            return flase;
        }

        $text = nl2br($text, false);
        $arrText = explode('<br>', $text);

        foreach ($arrText as $key => $val) {
            $val = trim($val);
            $val = stripslashes($val);
            $val = htmlspecialchars($val);
            $arrText[$key] = $val;
        }

        if ($html) {
            return implode('<br>', $arrText);
        }

        return implode('\r\n', $arrText);
    }
