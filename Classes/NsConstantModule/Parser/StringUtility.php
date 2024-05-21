<?php
namespace Nitsan\NsWhatsapp\NsConstantModule\Parser;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Class with helper functions for string handling
 * // @extensionScannerIgnoreLine
 */
class StringUtility
{
    /**
     * Removes the Byte Order Mark (BOM) from the input string. This method supports UTF-8 encoded strings only!
     *
     * @param string $input
     * @return string
     */
    public static function removeByteOrderMark(string $input): string
    {
        if (strpos($input, "\xef\xbb\xbf") === 0) {
            $input = substr($input, 3);
        }

        return $input;
    }
}
