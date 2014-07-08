<?php
/**
 * Created by PhpStorm.
 * User: x64
 * Date: 7/5/14
 * Time: 12:12 PM
 */

namespace Plugin\ImageAlbum\Entity;


use Plugin\ImageAlbum\AlbumImage;

class AlbumEntity {

    private $description;
    private $date;
    private $name;
    private $albumImage;

    private $id;

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
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * @param mixed $albumImage
     */
    public function setAlbumImage($albumImage)
    {
        $this->albumImage = $albumImage;
    }

    /**
     * @return mixed
     */
    public function getAlbumImage()
    {
        //Returns an Albumitem Entity
        $albumModel=new AlbumImage();
        $albumItem=$albumModel->getByID($this->albumImage);
        if($albumItem !== NULL){
        return $albumItem->getImages(true);
        }

    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

} 