<?php

require_once 'Mage/Checkout/controllers/CartController.php';

class PetCare_Reservation_CartController extends Mage_Checkout_CartController
{
    const RESERVATION_CATEGORY_ID = 3;
    public function addAction ()
    {
        if($this->_initProduct()->isVirtual() && $this->isReservation($this->_initProduct())) {
           
        } else {
            return parent::addAction();
        }

    }

    public function indexAction ()
    {
        return 1;
        parent::indexAction(); // TODO: Change the autogenerated stub
    }

    public function isReservation($product)
    {
        $categories = $product->getCategoryIds();
        if (in_array(self::RESERVATION_CATEGORY_ID, $categories)) {
            return true;
        } else {
            return false;
        }
    }
}
