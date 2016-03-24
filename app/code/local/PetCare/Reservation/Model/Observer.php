<?php

/**
 * Created by PhpStorm.
 * User: Bianca Vadean
 * Date: 24.03.2016
 * Time: 11:16
 */
class PetCare_Reservation_Model_Observer
{
    public function saveCustomOptions($observer)
    {
        $event = $observer->getEvent();
        $orderItems = $event->getOrder()->getAllVisibleItems();
        $customerId = $event->getOrder()->getCustomer()->getId();
        
        foreach ($orderItems as $item) {
            if($item->getProduct()->isVirtual() && in_array(5, $item->getProduct()->getCategoryIds())) {
                $itemId = $item->getItemId();
                $productId = $item->getProduct()->getId();
                $option = unserialize($item->getProduct()->getCustomOption('additional_options')->getValue());
                $startDate = $option['start_date'];
                $endDate = $option['end_date'];
                $reservation = Mage::getModel('reservation/reservation');
                $reservation->setProductId($productId);
                $reservation->setCustomerId($customerId);
                $reservation->setOrderItemId($itemId);
                $reservation->setStartDate($startDate);
                $reservation->setEndDate($endDate);
                $reservation->save();
            }

        }


    }
}
