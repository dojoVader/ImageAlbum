<?php
/**
 * Created by PhpStorm.
 * User: x64
 * Date: 7/5/14
 * Time: 12:16 PM
 */

namespace Plugin\ImageAlbum\Entity;


class AlbumImages {
    private $id;
    private $images;
    private $caption;
    private $date;
    private $album_id;
    private $_uploadPath;

    /**
     * @param mixed $album
     */
    public function setAlbumID($album)
    {
        $this->album_id = (int)$album;
    }


    public function __construct(){
        $this->_uploadPath=ipHomeUrl()."Plugin/ImageAlbum/uploads";
    }

    public function getAlbumID()
    {
      return $this->album_id;
    }



    /**
     * @param mixed $caption
     */
    public function setCaption($caption)
    {
        $this->caption = $caption;
    }

    /**
     * @return mixed
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = (int)$id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images)
    {
        $this->images = $images;
    }

    /**
     * Returns the Path to the Image
     * @param $thumbnailVersion if true returns the thumbnail or false image
     * @return mixed
     */
    public function getImages($thumbnailVersion=false)
    {
        $path=explode("/",$this->images);
        $splitPath=end($path);

        if($thumbnailVersion):
            return $this->_uploadPath."/thumb/".$splitPath;
        else:
            return $this->_uploadPath."/".$splitPath;
        endif;
    }
} 