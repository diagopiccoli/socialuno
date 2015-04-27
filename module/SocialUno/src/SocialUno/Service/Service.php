<?php

namespace SocialUno\Service;

use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;

abstract class Service implements ServiceManagerAwareInterface {

    protected $serviceManager;

    public function setServiceManager(ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
    }

    public function getServiceManager() {
        return $this->serviceManager;
    }

    public function getObjectManager() {
        $objectManager = $this->getService('Doctrine\ORM\EntityManager');
        return $objectManager;
    }

    protected function getService($service) {
        return $this->getServiceManager()->get($service);
    }
    
    public function dateToBanco($data){
        $new = explode("/", $data);
        return $new[2].'-'.$new[1].'-'.$new[0];
    }

}