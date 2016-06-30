<?php

namespace Icinga\Module\Enforceddashboard\Controllers;

use Icinga\Web\Controller;
use Icinga\Web\Widget\Dashboard;
use Icinga\User;

class DashboardController extends Controller
{
    /**
     * @var Dashboard;
     */
    private $dashboard;

    public function init()
    {
        $this->dashboard = new Dashboard();
        $this->dashboard->setUser(new User('enforced-dashboard'));
        $this->dashboard->load();
    }

    public function indexAction()
    {
        $this->view->tabs = $this->dashboard->getTabs();
        $this->view->dashboard = $this->dashboard;

        if (! $this->dashboard->hasPanes()) {
            $this->view->title = 'Dashboard';
            return;
        }

        if ($pane = $this->params->get('pane')) {
            $this->dashboard->activate($pane);
        } else {
            foreach ($this->dashboard->getPanes() as $key => $pane) {
                if (! $pane->getDisabled()) {
                    $this->dashboard->activate($key);
                    break;
                }
            }
        }

        $this->view->title = $this->dashboard->getActivePane()->getTitle() . ' :: Dashboard';
    }
}
