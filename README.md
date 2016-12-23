Composer Project Template for Drupal WxT
========================================

## Requirements

* [Composer][composer]
* [Node][node]

## Installation

Initialize a new project with this command:

```
$ composer create-project drupalwxt/wxt-project PROJECT_NAME
```

## Maintenance

List of common commands are as follows:

| Task                                            | Composer                                               |
|-------------------------------------------------|--------------------------------------------------------|
| Latest version of a contributed project         | ```composer require drupal/PROJECT_NAME```             |
| Specific version of a contributed project       | ```composer require drupal/PROJECT_NAME:1.0.0-beta5``` |
| Updating all projects including Drupal Core     | ```composer update```                                  |
| Updating a single contributed project           | ```composer update drupal/PROJECT_NAME```              |
| Updating Drupal Core exclusively                | ```composer update drupal/core```                      |

<!-- Links Referenced -->

[composer]:               https://getcomposer.org
[node]:                   https://nodejs.org
