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
  `date` datetime NOT NULL,
  `image` varchar(255) NOT NULL,
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
        //We don't want it removed just incase it is re-enabled in the future
    }

    public function remove()
    {
        $sql = 'DROP TABLE IF EXISTS ' . ipTable('album');
        $sql .= 'DROP TABLE IF EXISTS ' . ipTable('album_images');



        ipDb()->execute($sql);
    }

}