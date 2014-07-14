<?php
namespace Plugin\ImageAlbum\Setup;

class Worker extends \Ip\SetupWorker
{

    public function activate()
    {
        $sql1 = "
        CREATE TABLE IF NOT EXISTS ".ipTable('album')." (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `name` varchar (255) NOT NULL,
  `album_image_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Sarah''s Nest is the table' AUTO_INCREMENT=1 ;
        ";


        $sql2="CREATE TABLE IF NOT EXISTS ".ipTable('album_images')." (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `caption` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `album_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";



        ipDb()->execute($sql1);
        ipDb()->execute($sql2);

    }

    public function deactivate()
    {
       $sql1 = 'DROP TABLE IF EXISTS ' . ipTable('album');
        $sql2 = 'DROP TABLE IF EXISTS ' . ipTable('album_images');



        ipDb()->execute($sql1);
        ipDb()->execute($sql2);
    }

    public function remove()
    {
       
    }

}