<?php

namespace Plugin\ImageAlbum;

/**
 * This class is the Album Database that will store and save information for the table Album
 *
 * @author dojoVader
 *
 */
use Plugin\ImageAlbum\Entity\AlbumEntity;
use Plugin\ImageAlbum\Entity\AlbumImages;

class Model extends BaseModel
{
    public $name = "album";

    public function save(AlbumEntity $album)
    {
        $data = array(
            'description' => $album->getDescription(),
            'date' => $album->getDate(),
            'name' => $album->getName()

        );
        return ipDb()->insert("album", $data);
    }

    public function byId($id)
    {
        return ipDb()->selectRow($this->name, "*", array("id" => $id));
    }

    public function updateAlbumCover($albumID, $imageID)
    {
        return ipDb()->update($this->name, array('album_image_id' => $imageID), array('id' => $albumID));
    }

    public function returnAsObjectByID($id){
        $result=$this->byId($id);
        if($result){
            /**
             * @var $item \Plugin\ImageAlbum\Entity\AlbumEntity
             */
        $item=new AlbumEntity();
        $item->setID($result['id']);
        $item->setDescription($result['description']);
        $item->setName($result['name']);
        $item->setAlbumImage($result['album_image_id']);
        return $item;
        }
    }

    public function deleteAlbum($id){
        //Fetch Albumsitems First Delete then delete this one
        $albumImages=new AlbumImage();
        foreach($albumImages->getImages($id) as $row){
            $albumImages->delete('id',$row->getID());
        }
        return $this->delete('id',$id);

    }

    /**
     * This returns the Paginator holding the data
     *
     * @param string name of the table
     * @param int CurrentPage
     * @param int PageSize the number of Items to fetch
     * @return IP\Pagination if result is found and FALSE if empty result
     */
    public function getPaginator($table, $currentPageIdx, $pageSize)
    {
        // let's fetch the total from the Database first
        /**
         * @todo hardcoded value, change later
         */
        $pageSize = 30;
        $recordCount = (int)ipDb()->fetchValue(sprintf("SELECT COUNT(*) from %s", ipTable($table)));
        $totalPages = (int)ceil($recordCount / $pageSize);
        $currentPage = $currentPageIdx;
        if ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        }
        $from = (abs($currentPage - 1)) * $pageSize;

        //Empty Result
        $pagination = new \Ip\Pagination\Pagination (array(
            'data' => $this->fetch($from, $pageSize),
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'pagerSize' => $pageSize
        ));
        return $pagination;


    }

    private function fetch($from, $count, $where = 1)
    {

        $sortField = 'id';


        $sql = "
        SELECT
          *
        FROM
          " . ipTable($this->name) . "
        WHERE
          " . $where . "
        ORDER BY
            `" . $sortField . "`
                LIMIT
                $from, $count
                ";

        $result = ipDb()->fetchAll($sql);
        if ($result) {
            $resultItem = array();
            foreach ($result as $row):
                $Album = new AlbumEntity();
                $Album->setId($row['id']);
                $Album->setDate($row['date']);
                $Album->setDescription($row['description']);
                $Album->setAlbumImage($row['album_image_id']);
                $Album->setName($row['name']);
                $resultItem[] = $Album;
            endforeach;

            return $resultItem;
        } else {
            return NULL;
        }


    }


}

?>