<?php

class PetCare_Reservation_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        var_dump(Mage::getModel('reservation/reservation')->getCollection());
        echo "Evrika!";
    }
}
