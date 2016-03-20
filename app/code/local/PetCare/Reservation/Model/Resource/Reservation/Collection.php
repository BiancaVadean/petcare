<?php

/**
 * Created by PhpStorm.
 * User: Bianca Vadean
 * Date: 17.03.2016
 * Time: 20:43
 */
class PetCare_Reservation_Model_Resource_Reservation_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('reservation/reservation');
    }
}
