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

Currently there is no configuration. This proof of concept is intended to be used on the Islandora Playbook, with the GreatestHits server running on the laptop running Ansible. In that case, the server's address i `10.0.2.2.`. Therefore, while this is still a basic proof of concept, the address of remote GreatestHits server is hard coded to `http://10.0.2.2:3000`.

## Current maintainer

* [Mark Jordan](https://github.com/mjordan)

## License

[GPLv2](http://www.gnu.org/licenses/gpl-2.0.txt)
