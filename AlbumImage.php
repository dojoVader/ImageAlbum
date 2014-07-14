<?php
/**
 * Created by PhpStorm.
 * User: x64
 * Date: 7/6/14
 * Time: 11:43 AM
 */

namespace Plugin\ImageAlbum;
use Plugin\ImageAlbum\Entity\AlbumImages as ImageEntity;

class AlbumImage extends BaseModel {
    public $name="album_images";

    public function save(ImageEntity $image){
        $data=array(
            "image"=>$image->getImages(),
            "caption"=>$image->getCaption(),
            "date"=>$image->getDate(),
            "album_id"=>$image->getAlbumID()
        );

        return ipDb()->insert($this->name,$data);
    }

    /**
     * This function retrieves the Images from the Databases as Objects using the AlbumitemEntity
     * @param $albumId AlbumID
     * @return  [AlbumItemEntity] | null
     */
    public function getImages($albumId){
        $arrayAlbumItem=array();
        $results=ipDb()->selectAll($this->name,"*",array('album_id'=>$albumId));
        if($results){
            foreach($results as $item){
                $AlbumItem=new ImageEntity();
                $AlbumItem->setId($item['id']);
                $AlbumItem->setAlbumID($item['album_id']);
                $AlbumItem->setCaption($item['caption']);
                $AlbumItem->setDate($item['date']);
                $AlbumItem->setImages($item['image']);
                $arrayAlbumItem[]=$AlbumItem;
            }
            return $arrayAlbumItem;
        }else{
            return NULL;
        }
    }

    public function getSelectImages($id){
        $listObject=$this->getImages($id);
        $list=array();
        foreach($listObject as $images){
            $list[]=array($images->getID(),sprintf("Image %d",$images->getID()));
        }
        if(count($list)){
            return $list;
        }
        else{
            return FALSE;
        }
    }

    public function delete($whereKey,$whereValue){
        $this->beforeDelete($whereValue);
        return ipDb()->delete($this->name,array($whereKey=>$whereValue));
    }

    public function beforeDelete($id){
        //get the Image Folder
        $filePath=ipDb()->selectValue($this->name,"image",array('id'=>$id));
        $path=explode("/",$filePath);
        $splitPath=end($path);
        $fullPath=dirname(__FILE__)."/uploads/".$splitPath;
        $TPath=dirname(__FILE__)."/uploads/thumb/".$splitPath;
        chmod($fullPath,0666);
        chmod($TPath,0666);
        @unlink($fullPath);
        @unlink($TPath);

    }

    public function getByID($id){
        $result=ipDb()->selectRow($this->name,"*",array('id'=>$id));
        if($result){

            $AlbumItem=new ImageEntity();
            $AlbumItem->setId($result['id']);
            $AlbumItem->setAlbumID($result['album_id']);
            $AlbumItem->setCaption($result['caption']);
            $AlbumItem->setDate($result['date']);
            $AlbumItem->setImages($result['image']);


            return $AlbumItem;
        }else{
            return NULL;
        }
    }

}

