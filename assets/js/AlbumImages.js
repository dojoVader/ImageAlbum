/**
 * Created by x64 on 7/8/14.
 */
define(['dijit/Dialog'], function (dialog) {
    "use strict"
    var dia = new dialog({
        title: "Delete Page",
        content: "Attempting to Detelet Album Image from the Database"
    });

    return {
        /**
         * Deletes the Record from the Database using the Ajax Call
         * @param id AlbumItem ID from the Dataset
         */
        delete: function (id) {
            dia.show();
            $.ajax({
                type: 'POST',
                url: ip.baseUrl,
                data: {
                    aa: 'ImageAlbum.deleteAjax',
                    albumImageId: id,
                    securityToken: ip.securityToken,
                },
                cache: true,
                dataType: 'json'
            }).done(function (data) {
                    if ("status" in data) {
                        switch (data.status) {
                            case "error":
                                dia.set('content', data.errors);
                                dia.set('title', "Image Delete Status")
                                dia.show();

                                break;
                            case "success":
                                dia.set('content', data.message);
                                dia.set('title', "Image Delete Status")
                                dia.show();

                                break;
                        }
                    }
                //Remove from Node
                    $("#album"+id).remove();
                    dia.hide();
                }).fail(function (error) {

                    alert(error.responseText);
                });
        }
    };
});