<?php
/**
 * Created by PhpStorm.
 * User: x64
 * Date: 7/8/14
 * Time: 3:32 PM
 */

namespace Plugin\ImageAlbum;


class SiteController extends \Ip\Controller {

    public function viewAlbum(){
        //Display the Images in the Album
        $AlbumID=(int)ipRequest()->getQuery('id');
        $albumImages=new AlbumImage();
        $model=new Model();

        $listImages=ipView('view/frontend/_list.php',array('album'=>$model->returnAsObjectByID($AlbumID),'data'=>$albumImages->getImages($AlbumID)))->render();
        return ipView('view/frontend/image-items.php',array('data'=>($listImages !== null) ? $listImages : " No Images Attached"));

    }
} 