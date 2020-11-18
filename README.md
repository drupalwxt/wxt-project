Composer Project template for Drupal
====================================

[![Build Status][ci-badge]][ci]

Drupal WxT codebase for `<site-name>`.

## Requirements

* [Composer][composer]
* [Node][node]

## New Project (stable tag)

```sh
composer create-project drupalwxt/wxt-project:3.0.16 site-name
```

## New Project (dev)

```sh
composer create-project drupalwxt/wxt-project:8.x-dev site-name
```

## Containers (Optional)

For the (optional) container based development workflow this is roughly the steps that are followed.

> Note: The [docker-scaffold][docker-scaffold] has now been moved to its own repository. Should you wish to use the docker workflow you simply need to run the following command in the site-wxt repository's working directory.

```sh
# Git clone docker scaffold
git clone https://github.com/drupalwxt/docker-scaffold.git docker

# Create symlinks
ln -s docker/docker-compose.yml docker-compose.yml
ln -s docker/docker-compose-ci.yml docker-compose-ci.yml

# Composer install
export COMPOSER_MEMORY_LIMIT=-1 && composer install

# Make our base docker image
make build

# Bring up the dev stack
docker-compose -f docker-compose.yml up -d

# Install Drupal
make drupal_install

# Development configuration
./docker/bin/drush config-set system.performance js.preprocess 0 -y && \
./docker/bin/drush config-set system.performance css.preprocess 0 -y && \
./docker/bin/drush php-eval 'node_access_rebuild();' && \
./docker/bin/drush config-set wxt_library.settings wxt.theme theme-gcweb -y && \
./docker/bin/drush cr

# Migrate default content
./docker/bin/drush migrate:import --group wxt --tag 'Core' && \
./docker/bin/drush migrate:import --group gcweb --tag 'Core' && \
./docker/bin/drush migrate:import --group gcweb --tag 'Menu'
```

## Maintenance

List of common commands are as follows:

| Task                                            | Composer                                               |
|-------------------------------------------------|--------------------------------------------------------|
| Latest version of a contributed project         | ```composer require drupal/PROJECT_NAME:8.*```         |
| Specific version of a contributed project       | ```composer require drupal/PROJECT_NAME:8.1.0-beta5``` |
| Updating all projects including Drupal Core     | ```composer update```                                  |
| Updating a single contributed project           | ```composer update drupal/PROJECT_NAME```              |
| Updating Drupal Core exclusively                | ```composer update drupal/core```                      |

## Acknowledgements

Extended with code and lessons learned by the [Acquia Team](https://acquia.com) over at [Lightning](https://github.com/acquia/lightning) and [BLT](https://github.com/acquia/blt).

<!-- Links Referenced -->

[ci]:                       https://travis-ci.org/drupalwxt/site-wxt
[ci-badge]:                 https://travis-ci.org/drupalwxt/site-wxt.svg?branch=8.x
[composer]:                 https://getcomposer.org
[node]:                     https://nodejs.org
[docker-scaffold-readme]:   https://github.com/drupal-composer-ext/drupal-scaffold-docker/blob/8.x/README.md
[docker-readme]:            https://github.com/drupal-composer-ext/drupal-scaffold-docker/blob/8.x/template/docker/README.md
