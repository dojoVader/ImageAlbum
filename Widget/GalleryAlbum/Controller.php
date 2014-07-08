<?php
/**
 * @package ImpressPages

 *
 */
namespace Plugin\ImageAlbum\Widget\GalleryAlbum;





use Plugin\ImageAlbum\Model;
class Controller extends \Ip\WidgetController{


    public function getTitle() {
    	return __('SarahsNest Album', 'ipAdmin');

    }
    public function generateHtml($revisionId, $widgetId, $data, $skin)
    {
        $path2Plugin=dirname(dirname(dirname(__FILE__)));
        $model = new Model ();
        $currentPageIdx=ipRequest()->getQuery("current",1);
        $posts = $model->getPaginator("album", $currentPageIdx,30);
        $listMedia=$posts->render($path2Plugin.'/view/frontend/_albums.php');
        $data['content']= ($listMedia === null ) ? "<h1>No Albums Yet ..</h1>" : $listMedia;
    	return parent::generateHtml($revisionId, $widgetId, $data, $skin);
    }

}