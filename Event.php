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
		ipAddJs("http://localhost/dojo1.9/dojo/dojo.js");
			ipAddCss("http://localhost/dojo1.9/dijit/themes/claro/claro.css");
		// ipAddJs("http://ajax.googleapis.com/ajax/libs/dojo/1.9.1/dojo/dojo.js",null,50);

		// ipAddCss("http://ajax.googleapis.com/ajax/libs/dojo/1.9.1/dijit/themes/claro/claro.css");
		}
		else if($e['plugin'] === 'Diary' && $e['controller'] === "SiteController"){
			$path=ipFileUrl('Plugin/ImageAlbum/assets/js');
			ipAddJsContent("dojoConfig","var dojoConfig={
			async:true,
			parseOnLoad:false,
			selectorEngine: 'acme',
			packages
			:[{name:'Diary',location:'$path'}]
			}",40);
			// ipAddJs("http://ajax.googleapis.com/ajax/libs/dojo/1.9.1/dojo/dojo.js",null,50);
			ipAddJs("http://localhost/dojo1.9/dojo/dojo.js");
			ipAddCss("http://localhost/dojo1.9/dijit/themes/claro/claro.css");
			ipAddJs("assets/js/boot-front.js",null,90);
			ipAddJs("assets/js/holder.js",null,90);
			// ipAddCss("http://ajax.googleapis.com/ajax/libs/dojo/1.9.1/dijit/themes/claro/claro.css");
			//Font Awesome
			ipAddCss("http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css");
		}
	}
}

?>