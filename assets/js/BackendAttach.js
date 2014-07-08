/**
 * Created by x64 on 7/7/14.
 */
define(['dojo/on','ImageAlbum/AlbumImages'],function (on,album) {
    "use strict"
    return {
        bindEvents:function(){
            on($(".ajaxDelete"),'click',function(e){
                //For Browsers that don't support DataSet
                var id = e.currentTarget.dataset.deleteid ||  ParseInt(e.currentTarget.getAttribute('data-deleteid'));

                album.delete(id);
                //You Shall not Pass Buhahahahahahaha (-_-)
                e.preventDefault();
                e.stopPropagation();
            });
        }
    };
});