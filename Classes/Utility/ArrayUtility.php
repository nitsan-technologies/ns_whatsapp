<?php

namespace Nitsan\NsWhatsapp\Utility;

/**
 * Class containing more array helper functions.
 */
class ArrayUtility
{
    /**
     * Search $haystack recursive for keys $needle. Return an array that contains
     * all paths to the key as dot-separated strings, as expected by
     * TYPO3\CMS\Extbase\Utility\ArrayUtility::getValueByPath().
     *
     * @param array $haystack
     * @param string $needle
     * @param bool $includeNeedle
     * @param string $path
     * @return array
     */
    public static function getPathsToKey(array $haystack, $needle, $includeNeedle = false, $path = '')
    {
        $result = [];
        if (array_key_exists($needle, $haystack)) {
            $result[] = $path . ($includeNeedle ? '.' . $needle : '');
        }

        if ($path !== '') {
            $path .= '.';
        }

        foreach ($haystack as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, self::getPathsToKey($value, $needle, $includeNeedle, $path . $key));
            }
        }
        return $result;
    }
}
