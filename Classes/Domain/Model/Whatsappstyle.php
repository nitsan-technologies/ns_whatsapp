<?php

namespace Nitsan\NsWhatsapp\Domain\Model;

/***
 *
 * This file is part of the "Whatsapp" Extension for TYPO3 CMS.
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

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

class Whatsappstyle extends AbstractEntity
{
    /**
     * Image
     *
     * @var ObjectStorage<FileReference>
     */
    protected ObjectStorage $image;

    public function __construct()
    {
        $this->image = new ObjectStorage();
    }

    /**
     * heading
     *
     * @var string
     */
    protected string $heading = '';

    /**
     * heading
     *
     * @var string
     */
    protected string $deleteImg = '0';

    /**
     * text
     *
     * @var string
     */
    protected string $text = '';
    /**
     * upload
     *
     * @var string
     */
    protected string $upload = '';

    /**
     * bordercolor
     *
     * @var string
     */
    protected string $bordercolor = '';
    /**
     * htextcolor
     *
     * @var string
     */
    protected string $htextcolor = '';

    /**
     * hbgcolor
     *
     * @var string
     */
    protected string $hbgcolor = '';

    /**
     * hboredrcolor
     *
     * @var string
     */
    protected string $hboredrcolor = '';

    /**
     * imageurl
     *
     * @var string
     */
    protected string $imageurl = '';

    /**
     * textcolor
     *
     * @var string
     */
    protected string $textcolor = '';

    /**
     * bgcolor
     *
     * @var string
     */
    protected string $bgcolor = '';

    /**
     * height
     *
     * @var string
     */
    protected string $height = '';

    /**
     * border
     *
     * @var string
     */
    protected string $border = '';

    /**
     * size
     *
     * @var string
     */
    protected string $size = '';

    /**
     * font
     *
     * @var string
     */
    protected string $font = '';

    /**
     * animation
     *
     * @var string
     */
    protected string $animation = '';

    /**
     * imageposition
     *
     * @var string
     */
    protected string $imageposition = '';

    /**
     * style
     *
     * @var string
     */
    protected string $style = '';

    /**
     * Returns the heading
     *
     * @return string
     */
    public function getHeading(): string
    {
        return $this->heading;
    }

    /**
     * Sets the heading
     *
     * @param string $heading
     * @return void
     */
    public function setHeading(string $heading): void
    {
        $this->heading = $heading;
    }

    /**
     * Returns the text
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Returns the deleteImg
     *
     * @return string
     */
    public function getDeleteImg(): string
    {
        return $this->deleteImg;
    }

    /**
     * Returns the deleteImg
     *
     * @param string $deleteImg
     * @return void
     */
    public function setDeleteImg(string $deleteImg): void
    {
        $this->deleteImg = $deleteImg;
    }

    /**
     * Sets the text
     *
     * @param string $text
     * @return void
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * Returns the upload
     *
     * @return string
     */
    public function getUpload(): string
    {
        return $this->upload;
    }

    /**
     * Sets the upload
     *
     * @param string $upload
     * @return void
     */
    public function setUpload(string $upload): void
    {
        $this->upload = $upload;
    }

    /**
     * Returns the textcolor
     *
     * @return string
     */
    public function getTextcolor(): string
    {
        return $this->textcolor;
    }

    /**
     * Sets the textcolor
     *
     * @param string $textcolor
     * @return void
     */
    public function setTextcolor(string $textcolor): void
    {
        $this->textcolor = $textcolor;
    }

    /**
     * Returns the bgcolor
     *
     * @return string
     */
    public function getBgcolor(): string
    {
        return $this->bgcolor;
    }

    /**
     * Sets the bgcolor
     *
     * @param string $bgcolor
     * @return void
     */
    public function setBgcolor(string $bgcolor): void
    {
        $this->bgcolor = $bgcolor;
    }

    /**
     * Returns the height
     *
     * @return string
     */
    public function getHeight(): string
    {
        return $this->height;
    }

    /**
     * Sets the height
     *
     * @param string $height
     * @return void
     */
    public function setHeight(string $height): void
    {
        $this->height = $height;
    }

    /**
     * Returns the border
     *
     * @return string
     */
    public function getBorder(): string
    {
        return $this->border;
    }

    /**
     * Sets the border
     *
     * @param string $border
     * @return void
     */
    public function setBorder(string $border): void
    {
        $this->border = $border;
    }

    /**
     * Returns the size
     *
     * @return string
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * Sets the size
     *
     * @param string $size
     * @return void
     */
    public function setSize(string $size): void
    {
        $this->size = $size;
    }

    /**
     * Returns the font
     *
     * @return string 
     */
    public function getFont(): string
    {
        return $this->font;
    }

    /**
     * Sets the font
     *
     * @param string $font
     * @return void
     */
    public function setFont(string $font): void
    {
        $this->font = $font;
    }

    /**
     * @param ObjectStorage $image
     */
    public function setImage(ObjectStorage $image): void
    {
        $this->image = $image;
    }

    /**
     * @return ObjectStorage
     */
    public function getImage(): ObjectStorage
    {
        return $this->image;
    }

    /**
     * Removes a FileReference
     *
     * @param FileReference $imageToRemove The FileReference to be removed
     * @return void
     */
    public function removeImage(FileReference $imageToRemove): void
    {
        $this->image->detach($imageToRemove);
    }

    /**
     * Returns the animation
     *
     * @return string 
     */
    public function getAnimation(): string
    {
        return $this->animation;
    }

    /**
     * Sets the animation
     *
     * @param string $animation
     * @return void
     */
    public function setAnimation(string $animation): void
    {
        $this->animation = $animation;
    }

    /**
     * Returns the imageposition
     *
     * @return string 
     */
    public function getImageposition(): string
    {
        return $this->imageposition;
    }

    /**
     * Sets the imageposition
     *
     * @param string $imageposition
     * @return void
     */
    public function setImageposition(string $imageposition): void
    {
        $this->imageposition = $imageposition;
    }

    /**
     * Returns the style
     *
     * @return string 
     */
    public function getStyle(): string
    {
        return $this->style;
    }

    /**
     * Sets the style
     *
     * @param string $style
     * @return void
     */
    public function setStyle(string $style): void
    {
        $this->style = $style;
    }

    /**
     * Returns the bordercolor
     *
     * @return string 
     */
    public function getBordercolor(): string
    {
        return $this->bordercolor;
    }

    /**
     * Sets the bordercolor
     *
     * @param string $bordercolor
     * @return void
     */
    public function setBordercolor(string $bordercolor): void
    {
        $this->bordercolor = $bordercolor;
    }
    /**
     * Returns the htextcolor
     *
     * @return string 
     */
    public function getHtextcolor(): string
    {
        return $this->htextcolor;
    }

    /**
     * Sets the htextcolor
     *
     * @param string $htextcolor
     * @return void
     */
    public function setHtextcolor(string $htextcolor): void
    {
        $this->htextcolor = $htextcolor;
    }

    /**
     * Returns the hbgcolor
     *
     * @return string 
     */
    public function getHbgcolor(): string
    {
        return $this->hbgcolor;
    }

    /**
     * Sets the hbgcolor
     *
     * @param string $hbgcolor
     * @return void
     */
    public function setHbgcolor(string $hbgcolor): void
    {
        $this->hbgcolor = $hbgcolor;
    }

    /**
     * Returns the hboredrcolor
     *
     * @return string 
     */
    public function getHboredrcolor(): string
    {
        return $this->hboredrcolor;
    }

    /**
     * Sets the hboredrcolor
     *
     * @param string $hboredrcolor
     * @return void
     */
    public function setHboredrcolor(string $hboredrcolor): void
    {
        $this->hboredrcolor = $hboredrcolor;
    }

    /**
     * Returns the imageurl
     *
     * @return string 
     */
    public function getImageurl(): string
    {
        return $this->imageurl;
    }

    /**
     * Sets the imageurl
     *
     * @param string $imageurl
     * @return void
     */
    public function setImageurl(string $imageurl): void
    {
        $this->imageurl = $imageurl;
    }
}
