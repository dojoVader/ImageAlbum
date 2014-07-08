<?php
/**
 * Created by PhpStorm.
 * User: x64
 * Date: 7/5/14
 * Time: 10:55 PM
 */
/**
 * @var $album \Plugin\ImageAlbum\Entity\AlbumEntity
 */
?>

<div class="col-md-12" id="AlbumContent">

    <h3>Album - <?php echo $album->getName() ?></h3>
   <div class="row">
        <?php
        /**
         * @var $images \Plugin\ImageAlbum\Entity\AlbumImages
         */
        if(count($data)){
        foreach($data as $images):
                    ?>
        <div class="col-xs-6 col-md-4 albums">
            <a rel="lightbox" href="<?echo$images->getImages()?>" data-toggle="tooltip" title="<?php echo esc($images->getCaption()) ?>" class="thumbnail">

                <img alt="Image Album" src="<?php echo $images->getImages(true); ?>" style="width: 100%; display: block;">

                </a>

            <div class="clearfix"></div>
        </div>
        <?php endforeach;
        } else {?>
        <h4>Oops</h4>
            <hr/>
       <h5>Images have not been attached to this album yet</h5>
       <?php
        }
       ?>

    </div>

</div>