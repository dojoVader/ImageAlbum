<?php

namespace Plugin\ImageAlbum;

class Event {

	public static function ipBeforeController($e){
		//We don't want it to run on every Plugin

		if($e['plugin'] === "ImageAlbum" && $e['controller'] === "AdminController"){
		$submenu=Submenu::getSubmenuItems();
		ipAddCss("assets/css/album.css");
		ipResponse()->setLayoutVariable("submenu",$submenu);
		$path=ipFileUrl('Plugin/ImageAlbum/assets/js');
		ipAddJsContent("dojoConfig","var dojoConfig={
		async:true,
		parseOnLoad:false,
		selectorEngine: 'acme',
		 packages
		 :[{name:'ImageAlbum',location:'$path'}]
		}",40);
        
        ipAddJs($path."/holder.js");
		ipAddJs("http://localhost/dojo1.9/dojo/dojo.js");
		ipAddCss("http://localhost/dojo1.9/dijit/themes/claro/claro.css");
		ipAddJs($path."/boot.js");
		// ipAddJs("http://ajax.googleapis.com/ajax/libs/dojo/1.9.1/dojo/dojo.js",null,50);

		// ipAddCss("http://ajax.googleapis.com/ajax/libs/dojo/1.9.1/dijit/themes/claro/claro.css");
		}
		else if($e['plugin'] === 'ImageAlbum' && $e['controller'] === "SiteController"){
			$path=ipFileUrl('Plugin/ImageAlbum/assets/js');
            ipAddCss("assets/css/album.css");
			ipAddJsContent("dojoConfig","var dojoConfig={
			async:true,
			parseOnLoad:false,
			selectorEngine: 'acme',
			packages
			:[{name:'ImageAlbum',location:'$path'}]
			}",40);
			// ipAddJs("http://ajax.googleapis.com/ajax/libs/dojo/1.9.1/dojo/dojo.js",null,50);
			ipAddJs("http://localhost/dojo1.9/dojo/dojo.js");
			ipAddCss("http://localhost/dojo1.9/dijit/themes/claro/claro.css");
			// ipAddCss("http://ajax.googleapis.com/ajax/libs/dojo/1.9.1/dijit/themes/claro/claro.css");
			//Font Awesome

		}
	}
}

?>