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

    public function nextReservedDates($date)
    {
        $collection = $this->getCollection()
            ->addFieldToFilter('start_date', [ 'gteq' => date('Y-m-d')])
            ->addFieldToFilter('end_date', [ 'gteq' => date('Y-m-d')]);
        $nextReservations = [];
        foreach ($collection as $item) {
            if ($date === 'end') {
                $endDate = date('Y-m-d', strtotime($item->getData('end_date') . "+ 1 day"));
                $startDate = date('Y-m-d', strtotime($item->getData('start_date') . "+ 1 day"));
            } else {
                $startDate = $item->getData('start_date');
                $endDate = $item->getData('end_date');
            }

            $nextReservations = array_merge($nextReservations ,$this->generateInterval($startDate, $endDate));
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
        return $interval;
    }

    public function checkAvailableDates($start, $end)
    {
        $collection = $this->getCollection()
            ->addFieldToFilter(['start_date', "end_date"], [ 'gteq' => date('Y-m-d'), 'gteq' => date('Y-m-d')]);
        foreach ($collection as $item) {
            die(var_dump($collection));
            if (($end >= $item->getData('start_date')) && ($start < $item->getData('end_date')))  {

                return false;
            } 
        }
        return true;
    }
    
}
