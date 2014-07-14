/**
 * Created by x64 on 7/9/14.
 */
define(['dojo/on'],function (on) {

    return {
        bindDelete:function(){
            on($('.deleteAlbum'),'click',function(e){
            //Throw a Confirm Box to ask before allowing Page to Delete
                var Choice=window.confirm("Are you really certain of this, this will Delete Attached Images Also");
                if(Choice){
                    return true;
                }
                else{
                    return false;
                }
            });
        }
    };
});