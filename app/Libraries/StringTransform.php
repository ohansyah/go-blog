<?php

namespace App\Libraries;

class StringTransform
{
    /**
     * String Explode to array
     * Remove first space from array
     * Remove last space from array
     *
     * @param string $string
     * @param int $separator
     * @return array
     */
    public static function sExplode($string, $separator = ','): array
    {
        $tags = explode($separator, $string);
        for ($i = 0; $i < count($tags); $i++) {
            $tags[$i] = trim($tags[$i]);
        }

        // filter empty string
        $tags = array_filter($tags, function ($value) {
            return $value != '';
        });

        // remove duplicate
        $tags = array_unique($tags);

        return $tags;
    }

}
