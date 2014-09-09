 var PageModel=null;
 var PageController=null;
 require(['ImageAlbum/Manage','dojo/parser'],function(ManageController,parser){
        "use strict";
        $('document').ready(function(){
            document.body.className+=" claro";
            
            ManageController.bindEvent();
            PageModel=ManageController.BindableModel;
            PageController=ManageController;
            parser.parse();
        });
    });