<?php

$route = new Zend_Controller_Router_Route(
    'dashboard',
    array(
        'module'        => 'enforceddashboard',
        'controller'    => 'dashboard',
        'action'        => 'index',
    )
);

$this->addRoute('dashboard', $route);


