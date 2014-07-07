<?php
/**
 * Created by PhpStorm.
 * User: x64
 * Date: 7/6/14
 * Time: 7:33 AM
 */
?>
<div class="col-md-12" id="AlbumContent">
<!--Left-->
    <h1>Upload Images to the Following Album:[<?php echo $data['name']; ?>]</h1>
    <hr/>
    <div class="col-md-2">
        <div class="col-xs-12 col-md-12">
            <a href="#" data-toggle="tooltip" title="<?php echo esc($data['description']) ?>" class="thumbnail">
                <img data-src="holder.js/120x120" alt="120x120" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKsAAAC0CAYAAADraNxXAAAHAklEQVR4Xu2Y+UtUbxSHj6bkhoaJC+5llGZiguRS4P/ukliBImTuZivmUrngQvn9nhdGxmrGn8/nPheCyZl77/mc55kz73tL9vf3L42DDgToQAmyBqBEiakDyIoIYTqArGFQUSiy4kCYDiBrGFQUiqw4EKYDyBoGFYUiKw6E6QCyhkFFociKA2E6gKxhUFEosuJAmA4gaxhUFIqsOBCmA8gaBhWFIisOhOkAsoZBRaHIigNhOoCsYVBRKLLiQJgOIGsYVBSKrDgQpgPIGgYVhSIrDoTpALKGQUWhyIoDYTqArGFQUSiy4kCYDiBrGFQUiqw4EKYDyBoGFYUiKw6E6QCyhkFFociKA2E6gKxhUFEosuJAmA4gaxhUFIqsOBCmA8gaBhWFIisOhOkAsoZBRaHIigNhOoCsYVBRKLLiQJgOIGsYVBSKrDgQpgPIGgYVhSIrDoTpALKGQUWhyIoDYTqArGFQUSiy4kCYDiBrGFQUiqw4EKYDyBoGFYUiKw6E6QCyhkFFociKA2E6gKxhUFEosuJAmA4gaxhUFIqsOBCmA8gaBhWFIisOhOkAsoZBRaHIigNhOoCsYVBRKLLiQJgOIGsYVBSKrDgQpgPIGgYVhSIrDoTpALKGQUWhyIoDYTqArGFQUSiy4kCYDiBrGFQUiqw4EKYDyBoGFYUiKw6E6QCyhkFFociKA2E6gKxhUFEosuJAmA5kVtazszN7+/at7e3t2YMHD6yzszNB29zctPX19b8Ajo2NWVVVlRU67ybixc77+PGjvX//3s7Pz626utoePXpktbW16ZLfvn2ztbW1dN+6ujrr6+uz27dv33Q7yfczKevp6anNzc1ZeXm5HR8fX5P1x48fdnBwcAV7d3fXfv78aS9evLBfv34VPK+YHcXu59f2WhobG625udmWl5ettLTUxsfH7eLiwqanp62ysjK971+khoYGGxgYkJTxplCZlPXk5CRNVJ9er169uiZrfsN80s3MzFhra2v6TLHzchN5aGjI6uvr09T++vWrPXv2zEpKSgre79OnT7a0tGRPnz61u3fvpvM+f/5sExMT6ZzFxUUbHBxMkuau6e+50Fk7MilrDnJuquUvA/IFcDl2dnbSlPMpXOy8379/pwl5eXlpvb299vr1a+vp6bGurq6i5x0dHdns7GxahnR0dNj8/Lz5tUZHR6+WJP7alwcbGxvpn9fj0zZrB7L+L9i/ZPUp+vLlS+vu7rZ79+5d86KQ5IeHh0nYW7dupfXt8PBwmqo3fTl8vbq6upo+VlZWlibpnTt30lp1a2vrSk5/7X8bGRmxmpqarLlqyFpAVl87fvjwIa1V/9zQFJvIPlG/f/9uDx8+tPb29hsl9596n6b+WV8G+ObON1M+Tf3+/v/cZPXXvtxgsmbue2pp4+ST8F+TdXJy0ioqKtJ0/PModJ7v3BcWFtJPtm+OXLKblg/v3r0zfxrw/PnzdL/t7W1bWVkxX/v6NfLXrP7aN3y+Zs2f2FlBl8nJ6hsn3/H7Lt1/fltaWtIGxh8NuTD+96mpKWtra0uPkXJHsfP859uXDf7z7GtWf+07+MePH6dHUoXu5/K5sLnJ6mtSX0749PRreh35TwOamprSNbN4ZFJWF+fNmzd/8X7y5Im5DP74yp8S3L9/P61Zc0ex8/b39+3Lly9p95+/GfJdvu/cC93PhfYvjG/kXGoX09fIXocfvkzwSZt7ztrf339tWmdJ2kzKmiXASlmRVYmmeBZkFQesFA9ZlWiKZ0FWccBK8ZBViaZ4FmQVB6wUD1mVaIpnQVZxwErxkFWJpngWZBUHrBQPWZVoimdBVnHASvGQVYmmeBZkFQesFA9ZlWiKZ0FWccBK8ZBViaZ4FmQVB6wUD1mVaIpnQVZxwErxkFWJpngWZBUHrBQPWZVoimdBVnHASvGQVYmmeBZkFQesFA9ZlWiKZ0FWccBK8ZBViaZ4FmQVB6wUD1mVaIpnQVZxwErxkFWJpngWZBUHrBQPWZVoimdBVnHASvGQVYmmeBZkFQesFA9ZlWiKZ0FWccBK8ZBViaZ4FmQVB6wUD1mVaIpnQVZxwErxkFWJpngWZBUHrBQPWZVoimdBVnHASvGQVYmmeBZkFQesFA9ZlWiKZ0FWccBK8ZBViaZ4FmQVB6wUD1mVaIpnQVZxwErxkFWJpngWZBUHrBQPWZVoimdBVnHASvGQVYmmeBZkFQesFA9ZlWiKZ0FWccBK8ZBViaZ4FmQVB6wUD1mVaIpnQVZxwErxkFWJpngWZBUHrBQPWZVoimdBVnHASvGQVYmmeBZkFQesFA9ZlWiKZ0FWccBK8ZBViaZ4FmQVB6wUD1mVaIpnQVZxwErxkFWJpngWZBUHrBQPWZVoimdBVnHASvGQVYmmeJb/AJ6npUWqqXR4AAAAAElFTkSuQmCC" style="width: 100%; display: block;">
            </a>
            <div class="caption">
                <h3><?php  echo esc($data['name']); ?></h3>
                <p><?php echo esc($data['description']); ?></p>


            </div>
        </div>
    </div>
    <div class="col-md-4">
        <h4>Attached Images</h4>
        <hr/>
        <ul class="list-group">
            <?php if($list === NULL ):?>
            <li class="list-group-item">There no Images in this Album</li>
            <?php else: ?>

                <?php
                /**
                 * @var $imageItem \Plugin\ImageAlbum\Entity\AlbumImages
                 */
                foreach($list as $imageItem): ?>
            <li class="col-md-6 list-group-item"><img src="<?php echo $imageItem->getImages(true); ?>">
                <div class="clearfix"></div>
                <br/>
                <a href="#" class='btn btn-primary'>Delete Image</a>
            </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>
    <div class="col-md-6">
        <!--Dojo File Uploader-->
        <div class="dndUpload well">
            <form method="post" action="<?php echo ipActionUrl(array("aa"=>"ImageAlbum.uploadImages")); ?>" id="myForm" enctype="multipart/form-data" >
             <input class="btn btn-info" name="uploadedfile" multiple="true" type="file" data-dojo-type="dojox/form/Uploader" label="Select Some Files" id="uploader">

                <input type="hidden" name="subaction" value="dojoUpload" />
                <input type="button" value="Clear" id="clearUpload" class='btn btn-info' />
                <input type="submit" value="Upload" class='btn btn-info' />
                <input type="hidden" name="albumID" value="<?php echo $data['id'] ?>" />
                <input type="hidden" name="securityToken" value="<?php echo ipSecurityToken(); ?>"/>
               </form>

        </div>
        <div id="files" data-dojo-type="StylFileList" uploaderId="uploader"></div>
        <!--Dojo File Uploader-->
    </div>

</div>