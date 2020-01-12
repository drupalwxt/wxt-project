Composer Project template for Drupal
====================================

[![Build Status][ci-badge]][ci]

Drupal WxT codebase for `<site-name>`.

## Requirements

* [Composer][composer]
* [Node][node]

## New Project (stable tag)

```sh
composer create-project drupalwxt/wxt-project:3.0.6 site-name
```

## New Project (dev)

```sh
composer create-project drupalwxt/wxt-project:8.x-dev site-name
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


[ci]:                       https://travis-ci.org/drupalwxt/site-wxt
[ci-badge]:                 https://travis-ci.org/drupalwxt/site-wxt.svg?branch=8.x
[composer]:                 https://getcomposer.org
[node]:                     https://nodejs.org
[docker-scaffold-readme]:   https://github.com/drupal-composer-ext/drupal-scaffold-docker/blob/8.x/README.md
[docker-readme]:            https://github.com/drupal-composer-ext/drupal-scaffold-docker/blob/8.x/template/docker/README.md
