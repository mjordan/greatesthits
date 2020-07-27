# Greatest Hits

## Overview

Proof of concept module for wiring up a Drupal instance to use a GreatestHits server.

## Requirements

* [Drupal 8](https://github.com/Islandora/islandora)
* A [GreatestHits](https://github.com/mjordan/greatesthits_server) server

## Installation

1. Clone this repo into your Islandora's `drupal/web/modules/contrib` directory.
1. Enable the module either under the "Admin > Extend" menu or by running `drush en -y greatesthits`.

## Configuration

The only configuration option is the base URL of the GreatestHits server, which can be set at `/admin/config/system/greatesthits`. If you are running this on the Islandora Playbook, and your GreatestHits server is running on the Ansible host, the this setting should be address should be `http://10.0.2.2:3000`.

Also, there is a block, "GreatestHits for nodes", that shows the number of hits recorded by GreatestHits for the current node.

## Current maintainer

* [Mark Jordan](https://github.com/mjordan)

## License

[GPLv2](http://www.gnu.org/licenses/gpl-2.0.txt)
