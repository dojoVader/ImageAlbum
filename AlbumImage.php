<?php
/**
 * Created by PhpStorm.
 * User: x64
 * Date: 7/6/14
 * Time: 11:43 AM
 */

namespace Plugin\ImageAlbum;
use Plugin\ImageAlbum\Entity\Albumimages as ImageEntity;

class AlbumImage extends BaseModel {
    public $name="album_images";

    public function save(ImageEntity $image){
        $data=array(
            "image"=>$image->getImages(),
            "caption"=>$image->getCaption(),
            "date"=>$image->getDate(),
            "album_id"=>$image->getAlbum()
        );

        return ipDb()->insert($this->name,$data);
    }

    /**
     * This function retrieves the Images from the Databases as Objects using the AlbumitemEntity
     * @param $albumId the Id number of the Album
     * @return  [AlbumItemEntity] | null
     */
    public function getImages($albumId){
       $arrayAlbumItem=array();
       $results=ipDb()->selectAll($this->name,"*",array('id'=>$albumId));
        if($results){
        foreach($results as $item){
            $AlbumItem=new ImageEntity();
            $AlbumItem->setId($item['id']);
            $AlbumItem->setAlbum($item['album_id']);
            $AlbumItem->setCaption($item['caption']);
            $AlbumItem->setDate($item['date']);
            $arrayAlbumItem[]=$AlbumItem;
        }
            return $arrayAlbumItem;
        }else{
            return NULL;
        }
    }

}

