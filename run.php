<?php

$route = new Zend_Controller_Router_Route('dashboard', [
    'module'     => 'enforceddashboard',
    'controller' => 'dashboard',
    'action'     => 'index',
]);

$this->addRoute('dashboard', $route);
