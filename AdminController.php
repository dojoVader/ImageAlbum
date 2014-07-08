<?php

namespace Plugin\ImageAlbum;
use \Plugin\ImageAlbum\Form\Album as AlbumForm;
use \Plugin\ImageAlbum\Entity\AlbumEntity;
use \Plugin\ImageAlbum\Entity\AlbumImages;
use \Plugin\ImageAlbum\AlbumImage;
use \Plugin\ImageAlbum\Model;
use \Plugin\ImageAlbum\DojoUploader;

class AdminController extends \Ip\Controller
{
    /**
     * Uncomment this method and you will get admin menu entry.
     */
    public function index()
    {

        $model = new Model ();
        $currentPageIdx=ipRequest()->getQuery("current",1);
        $posts = $model->getPaginator("album", $currentPageIdx,30);
        $listMedia=$posts->render(__DIR__.'/view/backend/_albums.php');
        return ipView ( "view/backend/index.php", array (
            'albums' => ($listMedia === null ) ? "<h1>No Albums Yet ..</h1>" : $listMedia
        ) );
    }

    public function uploadImages(){
        if(ipRequest()->isPost()){
            $id=ipRequest()->getPost('albumID');
            $dojo=new DojoUploader(__DIR__."/uploads/");
            $result=$dojo->UploadFiles($id);
            return new \Ip\Response\Json($result);
        }
    }

    public function attach(){
        ipAddJsContent("create","
			require(['ImageAlbum/create'],function(create){


				});
				");
        $id=(int)ipRequest()->getQuery("id");
        if(!is_int($id)){
            throw new \Ip\Exception("Integer was Expected got Images");
        }
        $model=new Model();
        $data=$model->byId($id);
        $listObject=new AlbumImage();


        return ipView("view/backend/attach.php",array('data'=>$data,'list'=>$listObject->getImages($id)))->render();
    }

    /**
     * Delete the Record from the Database via Ajax
     * @return \Ip\Response\Json
     */
    public function deleteAjax(){
        if(ipRequest()->isPost()){

            $id=ipRequest()->getPost('albumImageId');
            $model=new AlbumImage();
            if(!$model->delete('id',$id)){
                //Error message to be thrown
                $data = array (
                    'status' => 'error',
                    'errors' =>'Error Could not delete the Image,Please inform the Developer'
                );
            }else{
                $data=array(
                    "status"=>"success",
                    "message"=>sprintf("The Image has been deleted successfully #%d",$id),
                    "redirect"=>true,
                    "recordID"=>$id
                );
            }
        return new \Ip\Response\Json($data);
        }


    }

    public function create(){
        $formAlbum=new AlbumForm();
        $data=null;
        if(ipRequest()->isPost()){

            $errors=$formAlbum->getForm()->validate(ipRequest()->getPost());
            if ($errors) {
                // error
                $data = array (
                    'status' => 'error',
                    'errors' => $errors
                );
            }else{
                //Let's Save the Database
                $entity=new AlbumEntity();
                $entity->setDate(date('Y-m-d H:i:s',time()));
                $entity->setDescription(ipRequest()->getPost('description'));
                $entity->setName(ipRequest()->getPost('name'));
                    $model=new Model();
                /**
                 * @var $model \Plugin\ImageAlbum\Model
                 */
                if(!$model->exists("name",$entity->getName())){
                if($model->save($entity)){
                    $data=array(
                        "status"=>"success",
                        "message"=>sprintf("The Album %s has been created successfully ",$entity->getName())
                    );
                }
                }
                else{
                    $data=array(
                        "status"=>"error",
                        "error"=>array("Item Exists"=>sprintf("The %s has already been created previously before"))
                    );
                }
            }




        }
        return ipView("view/backend/album.php",array('form'=>$formAlbum->getForm(),'data'=>$data))->render();

    }




}
