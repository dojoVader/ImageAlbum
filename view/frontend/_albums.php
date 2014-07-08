<?php
/**
 * Created by PhpStorm.
 * User: x64
 * Date: 7/5/14
 * Time: 10:55 PM
 */
?>

<div class="col-md-12" id="AlbumContent">
    <h3>Image Gallery</h3>
   <div class="row">
        <?php
        /**
         * @var $albums \Plugin\ImageAlbum\Entity\AlbumEntity
         */
        foreach($data as $albums): ?>
        <div class="col-xs-6 col-md-3 albums">
            <a href="#" data-toggle="tooltip" title="<?php echo esc($albums->getDescription()) ?>" class="thumbnail">
                <?php if($albums->getAlbumImage() === NULL):?>
                <img data-src="holder.js/120x120" alt="120x120" src="data:image/png;base64,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" style="width: 100%; display: block;">
                  <?php else: ?>
                <img alt="Image Album" src="<?php echo $albums->getAlbumImage(); ?>" style="width: 100%; display: block;">
                <?php endif; ?>
                </a>
            <div class="caption">
                <h5><?php  echo esc($albums->getName()); ?></h5>
                <small><?php echo $albums->getDescription(); ?></small>

            </div>
            <div class="clearfix"></div>
        </div>
        <?php endforeach; ?>
    </div>
    <!-- Pagination -->
    <?php if ($totalPages > 1) { ?>

        <ul class="pagination">
            <?php if ($currentPage > 1) { ?>
                <li><a href="<?php echo ipActionUrl(array("aa"=>"ImageAlbum.index","current"=>$currentPage - 1))?>" class="ipsAction" data-method="init" data-params="<?php echo escAttr(json_encode(array('page' => $currentPage - 1))) ?>">&laquo;</a></li>
            <?php } else { ?>
                <li class="disabled"><a href="#">&laquo;</a></li>
            <?php } ?>

            <?php foreach ($pages as $page) { ?>
                <?php if (is_numeric($page)) { ?>
                    <li <?php if ($page == $currentPage) { ?>class="active"<?php } ?>><a href="<?php echo ipActionUrl(array("aa"=>"ImageAlbum.index","current"=>$page))?>" class="ipsAction" data-method="init" data-params="<?php echo esc(json_encode(array('page' => $page))) ?>"><?php echo esc($page) ?></a></li>
                <?php } elseif (isset($page['page'])) { ?>
                    <li <?php if ($page['page'] == $currentPage) { ?>class="active"<?php } ?>><a href="<?php ipActionUrl(array("aa"=>"ImageAlbum.index","current"=>$page['page']))?>" class="ipsAction" data-method="init" data-params="<?php echo esc(json_encode(array('page' => $page['page']))) ?>"><?php echo esc(isset($page['text']) ? $page['text'] : $page['page']) ?></a></li>
                <?php } ?>
            <?php } ?>

            <?php if ($currentPage < $totalPages) { ?>
                <li><a href="<?php echo ipActionUrl(array("aa"=>"ImageAlbum.index","current"=>$currentPage + 1))?>" class="ipsAction" data-method="init" data-params="<?php echo escAttr(json_encode(array('page' => $currentPage + 1))) ?>">&raquo;</a></li>
            <?php } else { ?>
                <li class="disabled"><a href="#">&raquo;</a></li>
            <?php } ?>
        </ul>
    <?php } ?>
</div>