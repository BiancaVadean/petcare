<?php

/**
 * Created by PhpStorm.
 * User: Bianca Vadean
 * Date: 17.03.2016
 * Time: 20:43
 */
use Varien_Db_Ddl_Table;
class PetCare_Reservation_Model_Reservation extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('reservation/reservation');
    }
    
    public function validate()
    {
        return true;
    }

    public function loadNextReservations()
    {
         $collection = $this->getCollection()
            ->addFieldToFilter('start_date', [ 'gteq' => date('Y-m-d')]);
        $nextReservations = [];
        foreach ($collection as $item) {
            array_push($nextReservations, $item->getData());
        }
        return $nextReservations;
    }

    public function nextReservedDates()
    {
        $collection = $this->getCollection()
            ->addFieldToFilter('start_date', [ 'gteq' => date('Y-m-d')]);
        $nextReservations = [];
        foreach ($collection as $item) {
            $nextReservations = array_merge($nextReservations ,$this->generateInterval($item->getData('start_date'), $item->getData('end_date')));
        }
        return $nextReservations;
    }

    public function generateInterval($start, $end)
    {
        $period = new DatePeriod(
            new DateTime($start),
            new DateInterval('P1D'),
            new DateTime($end)
        );
        $interval = [];
        foreach ($period as $item) {
            array_push($interval, $item->format('Y-m-d'));
        }
//        var_dump($interval);
        return $interval;
    }
    
}
