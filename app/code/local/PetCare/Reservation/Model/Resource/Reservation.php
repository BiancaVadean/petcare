<?php

/**
 * Created by PhpStorm.
 * User: Bianca Vadean
 * Date: 17.03.2016
 * Time: 20:44
 */
class PetCare_Reservation_Model_Resource_Reservation extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('reservation/reservation', 'reservation_id');
    }
}
