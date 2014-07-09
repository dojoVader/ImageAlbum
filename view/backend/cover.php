<div class="col-md-12" id="AlbumContent">

   <table class="table table-hover"">
       <thead>
       <tr>
           <th>Image</th>
           <th>Action</th>
       </tr>

       </thead>
       <?php
       if(count($data)):
       foreach($data as $item): ?>
       <tbody>
       <tr>
           <td><img src='<?php echo $item->getImages(true);?>'/></td>
           <td><a class="btn btn-primary" href="<?php echo ipActionUrl(array('aa'=>'ImageAlbum.makeCover','album'=>$id,'imageID'=>$item->getID())); ?>">Make Album Cover</a></td>
       </tr>
       </tbody>
       <?php endforeach;
       else:
       ?>
    <h5>No Images attached in this Album</h5>
    <?php
        endif;
    ?>
   </table>

</div>