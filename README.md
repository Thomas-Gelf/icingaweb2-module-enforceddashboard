Icinga Web 2 - Enforced Dashboard
=================================

This module allows to work around an Icinga Web 2 limitation: currently there
is no Dashboard sharing/enforcement functionality.

Once this module has been installed and enabled, you can configure one of the
following new restrictions:

* `enforceddashboard/redirect-on-login`: specify a URL (relative to
  `/icingaweb2`). Users with this restriction instead of reaching their
  dashboard will be redirected to the given URL immediately after logging in.

* `enforceddashboard/dashboard-user`: specify a real (or virtual) username.
  Users with this restriction will be shown the dashboard of the given USer
You can do so either in your `roles.ini` or via `Configuration -> Authentication`.

Hardcoding a specific dashboard also disables add/modifiy/settings links in the
dashboard. Users will still see the "add to dashboard" link in extended tab actions.
What they store that way will be written to their user profile, but not have any
effect when showing their dashboard.

Usage
-----
Create your desired dashboard with any user. Then go to `/etc/icingaweb2/dashboards`
and copy `dashboard.ini` from your user to a new directory called `special-dashboard`.
The full path to your new dashboard.ini should therefore read like:

    /etc/icingaweb2/dashboards/special-dashboard/dashboard.ini

You could also manually create/modify this file and/or distribute it with your
favorite automation tool. And you can have as many such virtual users (like
`special-dashboard`) as you want. Feel free to restrict different roles to
different dashboards.
