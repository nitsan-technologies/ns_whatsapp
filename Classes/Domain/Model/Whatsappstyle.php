<?php

namespace Nitsan\NsWhatsapp\Domain\Model;

/***
 *
 * This file is part of the "NsWhatsapp" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2021
 *
 ***/
/**
 * Whatsappstyle
 */

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Whatsappstyle extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * text
     *
     * @var string
     */
    protected $text = '';

    /**
     * bordercolor
     *
     * @var string
     */
    protected $bordercolor = '';
    /**
     * htextcolor
     *
     * @var string
     */
    protected $htextcolor = '';

    /**
     * hbgcolor
     *
     * @var string
     */
    protected $hbgcolor = '';

    /**
     * hboredrcolor
     *
     * @var string
     */
    protected $hboredrcolor = '';

    /**
     * textcolor
     *
     * @var string
     */
    protected $textcolor = '';

    /**
     * bgcolor
     *
     * @var string
     */
    protected $bgcolor = '';

    /**
     * height
     *
     * @var string
     */
    protected $height = '';

    /**
     * border
     *
     * @var string
     */
    protected $border = '';

    /**
     * size
     *
     * @var string
     */
    protected $size = '';

    /**
     * style
     *
     * @var string
     */
    protected $style = '';

    /**
     * Returns the text
     *
     * @return string $text
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets the text
     *
     * @param string $text
     * @return void
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * Returns the textcolor
     *
     * @return string $textcolor
     */
    public function getTextcolor()
    {
        return $this->textcolor;
    }

    /**
     * Sets the textcolor
     *
     * @param string $textcolor
     * @return void
     */
    public function setTextcolor($textcolor)
    {
        $this->textcolor = $textcolor;
    }

    /**
     * Returns the bgcolor
     *
     * @return string $bgcolor
     */
    public function getBgcolor()
    {
        return $this->bgcolor;
    }

    /**
     * Sets the bgcolor
     *
     * @param string $bgcolor
     * @return void
     */
    public function setBgcolor($bgcolor)
    {
        $this->bgcolor = $bgcolor;
    }

    /**
     * Returns the height
     *
     * @return string $height
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Sets the height
     *
     * @param string $height
     * @return void
     */
    public function setHeight($height)
    {
        $this->height = $height;
    }

    /**
     * Returns the border
     *
     * @return string $border
     */
    public function getBorder()
    {
        return $this->border;
    }

    /**
     * Sets the border
     *
     * @param string $border
     * @return void
     */
    public function setBorder($border)
    {
        $this->border = $border;
    }

    /**
     * Returns the size
     *
     * @return string $size
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Sets the size
     *
     * @param string $size
     * @return void
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * Returns the style
     *
     * @return string $style
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * Sets the style
     *
     * @param string $style
     * @return void
     */
    public function setStyle($style)
    {
        $this->style = $style;
    }

    /**
     * Returns the bordercolor
     *
     * @return string $bordercolor
     */
    public function getBordercolor()
    {
        return $this->bordercolor;
    }

    /**
     * Sets the bordercolor
     *
     * @param string $bordercolor
     * @return void
     */
    public function setBordercolor($bordercolor)
    {
        $this->bordercolor = $bordercolor;
    }
    /**
     * Returns the htextcolor
     *
     * @return string $htextcolor
     */
    public function getHtextcolor()
    {
        return $this->htextcolor;
    }

    /**
     * Sets the htextcolor
     *
     * @param string $htextcolor
     * @return void
     */
    public function setHtextcolor($htextcolor)
    {
        $this->htextcolor = $htextcolor;
    }

    /**
     * Returns the hbgcolor
     *
     * @return string $hbgcolor
     */
    public function getHbgcolor()
    {
        return $this->hbgcolor;
    }

    /**
     * Sets the hbgcolor
     *
     * @param string $hbgcolor
     * @return void
     */
    public function setHbgcolor($hbgcolor)
    {
        $this->hbgcolor = $hbgcolor;
    }

    /**
     * Returns the hboredrcolor
     *
     * @return string $hboredrcolor
     */
    public function getHboredrcolor()
    {
        return $this->hboredrcolor;
    }

    /**
     * Sets the hboredrcolor
     *
     * @param string $hboredrcolor
     * @return void
     */
    public function setHboredrcolor($hboredrcolor)
    {
        $this->hboredrcolor = $hboredrcolor;
    }
}
