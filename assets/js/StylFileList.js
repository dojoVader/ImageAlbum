define(["dojo/_base/declare", 'dojox/form/uploader/FileList', 
	'dojo/text!./StylFileList.html'], function(extend, fileList, templateString) {
    return extend('StylFileList', fileList, {
        templateString: templateString,
        constructor: function(args) {
            extend.safeMixin(this, args);
        },
        _addRow: function(index, type, name, size){
        var _template='<li class="list-group-item">';
            _template+='<div class="checkbox col-md-12 col-lg-12 col-sm-12 col-xs-12">';
            _template+='<span class="glyphicon pull-left glyphicon-picture"></span>';
            _template+='<span class="pull-left">'+name+'</span> <span class="pull-right">'+this.convertBytes(size).value+'</span>';
            _template+='</div><div class="clearfix"></div>';
            _template+='</li>';
		var c, r = this.listNode;
		r.innerHTML+=_template;
	},

	reset: function(){
		this.listNode.innerHTML="";
		this.rowAmt = 0;
	}
    });
});