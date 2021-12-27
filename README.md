Composer Project template for Drupal
====================================

[![Build Status][githubci-badge]][githubci]

An composer project template generator for the [Drupal WxT][wxt] distribution.

> **Note**: You should consult the [README.md][wxt] file in the WxT repository for up-to-date information.

## Requirements

- [Composer][composer]
- [Node][node]

## Dependencies

The `composer.json` file calls the following dependencies:

- [WxT][wxt]

The [Drupal WxT][wxt] distribution is a web content management system which assists in building and maintaining innovative Web sites that are accessible, usable, and interoperable.

This distribution is open source software and free for use by departments and external Web communities. This distribution integrates extensively with the WET-BOEW jQuery Framework for improved accessible markup.

## Project

You can see an example of a generated Composer Project Template over at:

- [Site WxT][site-wxt]

The following is the command that was used for initial generation:

```sh
composer create-project drupalwxt/site-wxt:4.2.x-dev site-wxt
```

> **Note**: Normally you might want to use a stable tag such as `drupalwxt/site-wxt:4.2.x-dev`.

## Maintenance

List of common commands are as follows:

| Task                                        | Composer                                         |
| ------------------------------------------- | ------------------------------------------------ |
| Latest version of a contributed project     | `composer require drupal/PROJECT_NAME:1.*`       |
| Specific version of a contributed project   | `composer require drupal/PROJECT_NAME:1.0-beta5` |
| Updating all projects including Drupal Core | `composer update`                                |
| Updating a single contributed project       | `composer update drupal/PROJECT_NAME`            |
| Updating Drupal Core exclusively            | `composer update drupal/core`                    |

## Acknowledgements

Extended with code and lessons learned by the [Acquia Team](https://acquia.com) over at [Lightning](https://github.com/acquia/lightning) and [BLT](https://github.com/acquia/blt).

<!-- Links Referenced -->

[composer]:        https://getcomposer.org
[docker-scaffold]: https://github.com/drupalwxt/docker-scaffold.git
[githubci]:        https://github.com/drupalwxt/site-wxt/actions
[githubci-badge]:  https://github.com/drupalwxt/site-wxt/workflows/build/badge.svg
[node]:            https://nodejs.org
[site-wxt]:        https://github.com/drupalwxt/site-wxt
[wxt]:             https://github.com/drupalwxt/wxt
[wxt-project]:     https://github.com/drupalwxt/wxt-project
