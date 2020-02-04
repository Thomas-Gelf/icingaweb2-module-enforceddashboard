<?php

/** @var \Icinga\Application\Modules\Module $this */
$this->provideRestriction(
    'enforceddashboard/redirect-on-login',
    $this->translate('Redirect on login')
);
$this->provideRestriction(
    'enforceddashboard/dashboard-user',
    $this->translate('Enforce the Dashboard of this username')
);
