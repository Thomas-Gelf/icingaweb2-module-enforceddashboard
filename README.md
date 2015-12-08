Icinga Web 2 - Enforced Dashboard
=================================

Dashboard sharing is broken and will not be fixed in 2.1.x. This module allows
to have a common dashboard for all users. So what this fix does is loading just
one hardcoded dashboard (user: enforced-dashboard) for all of them. It also disables
add/modifiy/settings links in the dashboard. Users will still see the "add to
dashboard" link in extended tab actions. What they store that way will be
written to their user profile, but not have any effect when showing their
dashboard.

Usage
-----
Create your desired dashboard with any user. Then go to `/etc/icingaweb2/dashboards`
and copy `dashboard.ini` from your user to a new directory called `enforced-dashboard`.
The full path to your new dashboard.ini should therefore read like:

    /etc/icingaweb2/dashboards/enforced-dashboard/dashboard.ini

You could also manually create/modify this file and/or distribute it with your favorite
automation tool.

