<?php

namespace Icinga\Module\Enforceddashboard\Controllers;

use Icinga\Controllers\DashboardController as IcingaDashboardController;
use Icinga\Exception\NotFoundError;
use Icinga\Web\Widget\Dashboard;
use Icinga\User;

class DashboardController extends IcingaDashboardController
{
    /**
     * @var Dashboard;
     */
    private $dashboard;

    private $dashboardUser;

    protected $requiresAuthentication = false;

    public function init()
    {
        if ($this->Auth()->isAuthenticated()) {
            $restriction = 'enforceddashboard/redirect-on-login';
            foreach ($this->Auth()->getUser()->getRestrictions($restriction) as $url) {
                $this->redirectNow($url);
            }
        } else {
            $this->redirectToLogin();
        }

        $restriction = 'enforceddashboard/dashboard-user';
        foreach ($this->Auth()->getUser()->getRestrictions($restriction) as $user) {
            $this->dashboardUser = $user;
        }

        if ($this->dashboardUser) {
            $this->dashboard = new Dashboard();
            $this->dashboard->setUser($this->Auth()->getUser());
            $this->dashboard->setUser(new User($this->dashboardUser));
            $this->dashboard->load();
        } else {
            parent::init();
        }
    }

    public function indexAction()
    {
        if ($this->dashboardUser === null) {
            parent::indexAction();
            return;
        }
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

    /**
     * @throws NotFoundError
     */
    public function newDashletAction()
    {
        $this->forwardToParent('newDashletAction');
    }

    /**
     * @throws NotFoundError
     */
    public function updateDashletAction()
    {
        $this->forwardToParent('updateDashletAction');
    }

    /**
     * @throws NotFoundError
     */
    public function removeDashletAction()
    {
        $this->forwardToParent('removeDashletAction');
    }

    /**
     * @throws NotFoundError
     */
    public function renamePaneAction()
    {
        $this->forwardToParent('renamePaneAction');
    }

    /**
     * @throws NotFoundError
     */
    public function removePaneAction()
    {
        $this->forwardToParent('removePaneAction');
    }

    /**
     * @throws NotFoundError
     */
    public function settingsAction()
    {
        $this->forwardToParent('settingsAction');
    }

    /**
     * @param $action
     * @throws NotFoundError
     */
    protected function forwardToParent($action)
    {
        if (! $this->Auth()->isAuthenticated()) {
            $this->redirectToLogin();
        }
        if ($this->dashboardUser === null) {
            parent::$action();
        } else {
            throw new NotFoundError('Not found');
        }
    }
}
