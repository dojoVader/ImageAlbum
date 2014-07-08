//Gallery
define(['dojox/form/Uploader', 'ImageAlbum/StylFileList', 'dojo/on', 'dijit/registry', 'dojo/dom',
    'dojo/dom-construct', 'dojo/_base/lang', 'dijit/Dialog', 'dojo/request/xhr'], function (Uploader, fileList, on, widget, dom, construct, lang, dialog, xhr) {
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
            if ('wpdata in file') {
                for (c in file.wpdata) {

                    var divImage = construct.create("div", {
                        className: "col-sm-4 col-xs-6 col-md-3 col-lg-3"
                    });
                    var Ahref = construct.create("a", {
                        href: file.wpdata[c].fullImage,
                        rel: 'lightbox',
                        className: 'thumbnail fancybox'
                    }, divImage);
                    var Image = construct.create("img", {
                        src: file.wpdata[c].thumbnail,
                        className: 'img-polaroid',
                        style: 'height:209px !important'
                    }, Ahref);
                    //Add to the Gallery
                    dom.byId("imageList").appendChild(divImage);
                }
            }
        }
    };
    return StyljunkiGallery;
});