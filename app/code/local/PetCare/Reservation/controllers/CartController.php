<?php

class PetCare_Reservation_CartController extends Mage_Checkout_CartController
{
    public function addAction ()
    {
        return;
        if($this->_initProduct()->isVirtual()) {
            return null;
        } else {
//            return parent::addAction();
        }

    }
}
