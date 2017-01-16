Composer Project Template for Drupal
====================================

[![Build Status][ci-badge]][ci]

Drupal WxT codebase for `<site-name>`.

## Requirements

* [Composer][composer]
* [Node][node]

## Maintenance

List of common commands are as follows:

| Task                                            | Composer                                               |
|-------------------------------------------------|--------------------------------------------------------|
| Latest version of a contributed project         | ```composer require drupal/PROJECT_NAME:8.*```         |
| Specific version of a contributed project       | ```composer require drupal/PROJECT_NAME:8.1.0-beta5``` |
| Updating all projects including Drupal Core     | ```composer update```                                  |
| Updating a single contributed project           | ```composer update drupal/PROJECT_NAME```              |
| Updating Drupal Core exclusively                | ```composer update drupal/core```                      |


[ci]:                   https://travis-ci.org/drupalwxt/site-wxt
[ci-badge]:             https://travis-ci.org/drupalwxt/site-wxt.svg?branch=master
[composer]:             https://getcomposer.org
[node]:                 https://nodejs.org
