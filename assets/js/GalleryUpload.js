//Gallery
define(['dojox/form/Uploader', 'ImageAlbum/StylFileList', 'dojo/on', 'dijit/registry', 'dojo/dom',
    'dojo/dom-construct', 'dojo/_base/lang', 'dijit/Dialog', 'dojo/request/xhr'],
    function (Uploader, fileList, on, widget, dom, construct, lang, dialog, xhr) {
    "use strict";
    var DialogUI = new dialog({title: "Status"});
    document.body.className += " claro";
    var StyljunkiGallery = {
        bind: function () {
            //Connect the Clear button
            on(dom.byId('clearUpload'), 'click', function (e) {

                widget.byId('uploader').reset();
                //Block Events
                e.preventDefault();
                e.stopPropagation();
            });

            on(widget.byId('uploader'), 'Complete', function (e) {
                if (e.error) {
                    DialogUI.set('content', e.error);
                    DialogUI.show();
                }
                else {
                    StyljunkiGallery.addFileDiv(e);
                }
            });


        },
        addFileDiv: function (file) {
            console.log("Complete");

                if('status' in file){
                    file.forEach(function(item,index,array){
                    var divImage = construct.create("li", {
                        className: "col-md-6 list-group-item",
                        id:'album'+file.lastID
                    });

                    var Image = construct.create("img", {
                        src: file.wpdata[c].thumbnail,
                        className: 'img-responsive'
                    }, divImage);
                divImage.innerHTML+="<div class=\"clearfix\"></div><br/>";
                var Ahref = construct.create("a", {
                    href: file[index].fullimage,
                    rel: 'lightbox',
                    className: 'thumbnail fancybox'
                }, divImage);
                    //Add to the Gallery
                    $("ul.list-group").appendChild(divImage);
                });
                }

        }
    };
    return StyljunkiGallery;
});