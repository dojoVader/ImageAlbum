<script type="dojo/require">at: "dojox/mvc/at"</script>
<div class="col-md-12" id="galleryBoard">
    <div class="col-md-9" id="leftBoard">
        <ol class="breadcrumb">
            <li><a href="#">Album</a></li>
            <li><a href="#"><?php echo $data['title']['name'] ?></a></li>

        </ol>
        <div class="col-md-12">
            <div class="row">
                <?php
                $linkUrl=ipActionUrl(array("aa"=>"ImageAlbum.saveJson"));
                if(count($data['modelImages'])):
                foreach($data['modelImages'] as $item): ?>
                    <a href="<?php echo ipActionUrl(array('aa'=>'ImageAlbum.getJson','id'=>$item->getID())) ?>" class="anchorImage" data-image-id="<?php echo $item->getID() ?>">
                    <div class="col-md-2 col-sm-4 col-xs-6 galleryItem"><img class="img-responsive" src="<?php echo $item->getImages(true);?>" /></div>
                    </a>
                <?php endforeach;
                else:
                    ?>
                    <h5>No Images attached in this Album</h5>
                <?php
                endif;
                ?>
            </div>
        </div>
    </div>
    <div class="col-md-3" id="rightBoard">
        <h3>Image Settings</h3>
       <div class="row">
           <div class="col-xs-12 col-md-12">
              <form action="">
               <a href="#" class="thumbnail">
                  <img data-dojo-type="dojox/mvc/Output" data-dojo-props="src:at(PageModel,'albumUrl')" src="<?php echo ipFileUrl('Plugin/ImageAlbum/assets/js/')?>holder.js/300x180" alt="...">
               </a>
               <h3>Caption</h3>
               <textarea onkeydown="PageModel.set('caption',this.value);"  class="form-control" data-dojo-type='dojox/mvc/Output' data-dojo-props="value: at(PageModel, 'caption')" id="" cols="30" rows="2"></textarea>
               <br/>
               <input type="checkbox" onchange="PageModel.set('isAlbumCover',this.checked ? true: false )" /> Set as Image Album
               <br/><br/>
               <button type="button" onclick="PageController.commit('<?php echo $linkUrl ?>')" class="btn btn-primary">Apply</button>
               </form>
           </div>
       </div>
    </div>
</div>
