<?php

class Application_Model_DbTable_Images extends Zend_Db_Table_Abstract
{
    protected $_name = 'image_details';

    public function getImage($id)
    {
        $id = (int) $id;
        $row = $this->fetchRow('id = '.$id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }

        return $row->toArray();
    }

    public function addImage($image)
    {
        $data = array(
            'image' => $image,
        );
        $this->insert($data);
    }
}
