/**
 * Created by x64 on 9/7/14.
 */
define(['dojo/on','dojo/query','dojo/Stateful','dojox/mvc/Output','dojo/request/xhr','dijit/Dialog'],
    function (on,query,stateful,output,xhr,modal) {
    return {
        commit:function(url){
            var _this=this;
          return xhr.post(url,{
            handleAs:"json",
              data:{
                  securityToken:ip.securityToken,
                  imageID:_this.BindableModel.get('imageID'),
                  caption:_this.BindableModel.get('caption'),
                  isAlbumCover:_this.BindableModel.get('isAlbumCover')
              }
          }).then(function(item){
              var dialog=new modal({
                title:"Database Status",
                content:""
              });
                  dialog.set('content',item.message);
           });
        },
        getDetails:function(url){
            return xhr.post(url, {
                    handleAs: "json",
                    data:{
                        securityToken: ip.securityToken
                    }                    
                });
        },
    	BindableModel:new stateful({
         caption:"Select an Image...",
         imageID:"",
         isAlbumCover:false,
         albumUrl:""   
        }),
    	/*Binds all the events on the Page*/
        bindEvent:function(){
         //Let's bind an event on click
    //      this.BindableModel.watch("isAlbumCover", function(name, oldValue, value){
		  //   // Do something based on the change
    //          if(value === true){
    //             //Store Message
    //             window.neverRemind=false;
    //             if(window.neverRemind === false){
    //             alert("This is will replace the Current Album Cover");
    //             }
    //             window.neverRemind=true;
    //          }
		  // });
         var _this=this;
         on(query('#galleryBoard .anchorImage'),'click',function(e){
         	//Set the Data as Active and Fetch the Information
            $('#galleryBoard .anchorImage').removeClass('actvice');
            $('img',e.currentTarget).addClass('active');
            var imageid=parseInt(e.currentTarget.getAttribute('data-image-id'));
               _this.getDetails(e.currentTarget.href).then(function(item){
                    //Set the Model
                   
                   _this.BindableModel.set('caption',item.caption);
                   _this.BindableModel.set('albumUrl',item.albumUrl);
                   _this.BindableModel.set('imageID',imageid);

               },function(error){

               });
         	//End the Event
         	e.preventDefault();
         	e.stopPropagation();
         });
        }
    };
});