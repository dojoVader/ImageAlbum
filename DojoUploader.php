<?php
namespace Plugin\ImageAlbum;
use Plugin\ImageAlbum\Services_JSON;
use Plugin\ImageAlbum\Entity\AlbumImages as ImageEntity;
use Plugin\ImageAlbum\AlbumImage as ImageModel;
use Plugin\ImageAlbum\gdResize;
class DojoUploader
{

    private $finalDestination;

    /**
     * Find the temporary folder on the server
     * @return null|string
     */

    public function __construct($finalDestiny)
    {
        $this->finalDestination = $finalDestiny;
    }

    public function makeThumbnail($name){
        //Explode and get the path
        $path=explode("/",$name);
        $splitPath=end($path);
        $thumbnail_EventsImages=new gdResize($name);
        $thumbnail_EventsImages->resizeImage(120, 120,'crop');
        $thumbnail_EventsImages->saveImagetoFolder($this->finalDestination."/thumb/",$splitPath,90);
    }

    public function findTempDirectory()
    {
        if (isset($_ENV["TMP"]) && is_writable($_ENV["TMP"])) return $_ENV["TMP"];
        elseif (is_writable(ini_get('upload_tmp_dir'))) return ini_get('upload_tmp_dir');
        elseif (isset($_ENV["TEMP"]) && is_writable($_ENV["TEMP"])) return $_ENV["TEMP"];
        elseif (is_writable("/tmp")) return "/tmp";
        elseif (is_writable("/windows/temp")) return "/windows/temp";
        elseif (is_writable("/winnt/temp")) return "/winnt/temp";
        else return null;
    }

    /**
     * Finds the extension of the images
     * @param $filename
     * @return string
     */
    public function getImageType($filename)
    {
        return strtolower(substr(strrchr($filename, "."), 1));
    }

    public function UploadFiles($Albumid)
    {


        $upload_path = $this->finalDestination; // where image will be uploaded, relative to this file
        $download_path = $upload_path; // same folder as above, but relative to the HTML file
        //create a thumbnail version of the same image

        //
        // 	NOTE: maintain this path for JSON services
        //

        $json = new Services_JSON();

        //
        // 	Determine if this is a Flash upload, or an HTML upload
        //
        //

        //		First combine relavant postVars
        $postdata = array();
        $htmldata = array();
        $data = "";

        foreach ($_POST as $nm => $val) {
            $data .= $nm . "=" . $val . ","; // string for flash
            $postdata[$nm] = $val; // array for html
        }


        $fieldName = "flashUploadFiles"; //Filedata";

        if (isset($_FILES[$fieldName]) || isset($_FILES['uploadedfileFlash'])) {
            //
            // If the data passed has $fieldName, then it's Flash.
            // NOTE: "Filedata" is the default fieldname, but we're using a custom fieldname.
            // The SWF passes one file at a time to the server, so the files come across looking
            // very much like a single HTML file. The SWF remembers the data and returns it to
            // Dojo as an array when all are complete.
            //


            $returnFlashdata = true; //for dev

            if (isset($_FILES[$fieldName])) {
                // backwards compat - FileUploader

                $m = move_uploaded_file($_FILES[$fieldName]['tmp_name'], $upload_path . $_FILES[$fieldName]['name']);
                $name = $_FILES[$fieldName]['name'];
                $tmp = $_FILES[$fieldName]['tmp_name'];

            } else {
                // New fieldname - Uploader

                $m = move_uploaded_file($_FILES['uploadedfileFlash']['tmp_name'], $upload_path . $_FILES['uploadedfileFlash']['name']);
                $name = $_FILES['uploadedfileFlash']['name'];

            }


            $file = $upload_path . $name;
            try {
                list($width, $height) = getimagesize($file);
            } catch (Exception $e) {
                $width = 0;
                $height = 0;
            }
            $type = $this->getImageType($file);

            // 		Flash gets a string back:

            //exit;

            $data .= 'file=' . $file . ',name=' . $name . ',width=' . $width . ',height=' . $height . ',type=' . $type;
            if ($returnFlashdata) {

                // echo sends data to Flash:
                echo($data);
                // return is just to stop the script:
                return;
            }

        } elseif (isset($_FILES['uploadedfile0'])) {
            //
            //	Multiple files have been passed from HTML
            //
            $cnt = 0;


            $_post = $htmldata;
            $htmldata = array();

            while (isset($_FILES['uploadedfile' . $cnt])) {

                $moved = move_uploaded_file($_FILES['uploadedfile' . $cnt]['tmp_name'], $upload_path . $_FILES['uploadedfile' . $cnt]['name']);

                if ($moved) {
                    $name = $_FILES['uploadedfile' . $cnt]['name'];
                    $file = $upload_path . $name;
                    $type = $this->getImageType($file);
                    try {
                        list($width, $height) = getimagesize($file);
                    } catch (Exception $e) {
                        $width = 0;
                        $height = 0;
                    }


                    $_post['file'] = $file;
                    $_post['name'] = $name;
                    $_post['width'] = $width;
                    $_post['height'] = $height;
                    $_post['type'] = $type;
                    $_post['size'] = filesize($file);
                    $_post['additionalParams'] = $postdata;


                    $htmldata[$cnt] = $_post;

                } elseif (strlen($_FILES['uploadedfile' . $cnt]['name'])) {
                    $htmldata[$cnt] = array("ERROR" => "File could not be moved: " . $_FILES['uploadedfile' . $cnt]['name']);
                }
                $cnt++;
            }


        } elseif (isset($_POST['uploadedfiles'])) {


        } elseif (isset($_FILES['uploadedfiles'])) {
            //
            // 	If the data passed has 'uploadedfiles' (plural), then it's an HTML5 multi file input.
            //
            $cnt = 0;

            //
            //print_r($_FILES);
            $_post = $postdata;


            $htmldata = array();
            $len = count($_FILES['uploadedfiles']['name']);
            //
            // Ugh. The array passed from HTML to PHP is fugly.
            //

            //print_r($_FILES['uploadedfiles']);

            for ($i = 0; $i < $len; $i++) {
                $moved = move_uploaded_file($_FILES['uploadedfiles']['tmp_name'][$i], $upload_path . $_FILES['uploadedfiles']['name'][$i]);

                if ($moved) {
                    $name = $_FILES['uploadedfiles']['name'][$i];
                    $file = $upload_path . $name;
                    $type = $this->getImageType($file);
                    try {
                        list($width, $height) = getimagesize($file);
                    } catch (Exception $e) {
                        error_log("NO EL MOVEO: " . $name);
                        $width = 0;
                        $height = 0;
                        $_post['filesInError'] = $name;
                    }

                    if (!$width) {
                        $_post['filesInError'] = $name;
                        $width = 0;
                        $height = 0;
                    }


                    $_post['file'] = $file;
                    $_post['name'] = $name;
                    $_post['width'] = $width;
                    $_post['height'] = $height;
                    $_post['type'] = $type;
                    $_post['size'] = filesize($file);
                    //$_post['additionalParams'] = $postdata;
                    //

                    $htmldata[$cnt] = $_post;
                    //Save the Data to the EventImages
                    $AlbumModel=new ImageModel();
                    $AlbumItem=new ImageEntity();
                    $AlbumItem->setDate(date( 'Y-m-d H:i:s', time()));
                    $AlbumItem->setCaption("No Caption Set One");
                    $AlbumItem->setAlbumID($Albumid);
                    $AlbumItem->setImages($_post['name']);
                    $AlbumModel->save($AlbumItem);
                    $this->makeThumbnail($file);

                } elseif (strlen($_FILES['uploadedfiles']['name'][$i])) {
                    $htmldata[$cnt] = array("ERROR" => "File could not be moved: " . $_FILES['uploadedfiles']['name'][$i]);
                }
                $cnt++;
            }
            $tmp = $_post['file'];





            return $htmldata;

        } elseif (isset($_FILES['uploadedfile'])) {
            //
            // 	If the data passed has 'uploadedfile', then it's HTML.
            //	There may be better ways to check this, but this *is* just a test file.
            //
            if (!ipRequest()->isPost()):
                $m = move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $upload_path . $_FILES['uploadedfile']['name']);
                //$galleryRecord=new GalleryRecords();
                //$galleryRecord->refId=$id;
                //$galleryRecord->type="hound";
                //$galleryRecord->filename=$_FILES['uploadedfile']['name'];
                $tmp = $_FILES['uploadedfile']['tmp_name'];
                $AlbumModel=new ImageModel();
                $AlbumItem=new ImageEntity();
                $AlbumItem->setDate(date( 'Y-m-d H:i:s', time()));
                $AlbumItem->setCaption("No Caption Set One");
                $AlbumItem->setAlbumID($Albumid);
                $AlbumItem->setImages($_post['name']);
                $AlbumModel->save($AlbumItem);
                $this->makeThumbnail($tmp);


                $name = $_FILES['uploadedfile']['name'];
                $file = $upload_path . $name;
                $type = $this->getImageType($file);
                try {
                    list($width, $height) = getimagesize($file);
                } catch (Exception $e) {
                    $width = 0;
                    $height = 0;
                }


                $htmldata['file'] = $file;
                $htmldata['name'] = $name;
                $htmldata['width'] = $width;
                $htmldata['height'] = $height;
                $htmldata['type'] = $type;
                $htmldata['size'] = filesize($file);
                $htmldata['additionalParams'] = $postdata;
                return new \Ip\Response\Redirect(ipActionUrl(array("aa"=>"ImageAlbum.imagePosted")));
            endif;


        } elseif (isset($_GET['rmFiles'])) {

            $rmFiles = explode(";", $_GET['rmFiles']);
            foreach ($rmFiles as $f) {
                if ($f && file_exists($f)) {

                }
            }

        } else {


            $htmldata = array("ERROR" => "Improper data sent - no files found");
        }

    }
}

