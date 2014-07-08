/**
 * Created by x64 on 7/6/14.
 */
 define(['ImageAlbum/GalleryUpload', 'dojo/parser','ImageAlbum/BackendAttach'], function (uploader,parser,albumBackend) {
   "use strict"
    /**
     * @var parser Dojo/Parser
     */

    parser.parse();
    uploader.bind();
    albumBackend.bindEvents();

 });