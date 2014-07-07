<?php

namespace Plugin\ImageAlbum;

/**
 * This class is the Album Database that will store and save information for the table Album
 *
 * @author dojoVader
 *
 */
use \Plugin\ImageAlbum\Entity\AlbumEntity;

class Model extends BaseModel {
	public $name="album";
	public function save(AlbumEntity $album) {
        $data=array(
            'description'=>$album->getDescription(),
            'date'=>$album->getDate(),
            'name'=>$album->getName()

        );
		return ipDb ()->insert ( "album", $data );
	}

    public function byId($id){
        return ipDb()->selectRow($this->name,"*",array("id"=>$id));
    }











}

?>