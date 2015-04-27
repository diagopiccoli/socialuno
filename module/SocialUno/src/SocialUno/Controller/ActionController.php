<?php

namespace SocialUno\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class ActionController extends AbstractActionController {
    
    public function getObjectManager() {
        return $this->getService('Doctrine\ORM\EntityManager');
        
    }

    protected function getService($service) {
        return $this->getServiceLocator()->get($service);
    }
  
    protected function getRole(){
        return $this->getService('Session')->offsetGet('role');
    }

}