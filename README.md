# Composer Project template for Drupal

[![Build Status][githubci-badge]][githubci]

An **[composer][composer]** project template generator for the **[Drupal WxT][wxt]** distribution.

> **Note**: Please consult the **[README.md][readme]** file in the **Drupal WxT** repository for up-to-date information.

## Requirements

- **[Composer][composer]**
- **[Node][node]**

## Dependencies

The `composer.json` file calls the following dependencies:

- **[WxT][wxt]**

The **[Drupal WxT][wxt]** distribution is a web content management system which assists in building and maintaining innovative Web sites that are accessible, usable, and interoperable.

This distribution is open source software and free for use by departments and external Web communities. This distribution integrates extensively with the WET-BOEW jQuery Framework for improved accessible markup.

## Get Started

The following command is all you need to get started:

```sh
composer create-project drupalwxt/wxt-project:5.0.1 <site-name>
```

> **Note**: For development you may also specify a branch using `drupalwxt/wxt-project:5.0.x-dev`.

You can see a working example of a fully generated Composer Project Template over at:

- **[Site WxT][site-wxt]**

Where the following is the command that was used for the initial generation:

```sh
composer create-project drupalwxt/wxt-project:5.0.1 site-wxt
```

> **Note**: Remember to keep the `composer.json` and `composer.lock` files that exist above `docroot` in source control as they are controlling your dependencies.

## Maintenance

List of common commands are as follows:

| Task                                            | Composer                                      |
| ----------------------------------------------- | --------------------------------------------- |
| Installing a contrib project (latest version)   | `composer require drupal/PROJECT`             |
| Installing a contrib project (specific version) | `composer require drupal/PROJECT:1.0.0-beta5` |
| Updating all projects including Drupal Core     | `composer update`                             |
| Updating a single contrib project               | `composer update drupal/PROJECT_NAME`         |
| Updating Drupal Core                            | `composer update drupal/core`                 |

> **Note**: Composer is a **dependency manager** and helps us keep track of what code and at what version our application relies on so that it always get installed the right way on every copy of that application.

### Specifying a version

A specific version can be specified from the cli:

```sh
composer require drupal/<modulename>:<version>
```

However please note if you specify a branch, such as 1.x you must add `-dev` to the end of the version:

```sh
composer require drupal/token:1.x-dev
```

### Source Control

Taking a look at the `.gitignore` file, you will discover that certain directories, including all those directories containing contributed projects, are excluded from source control which is by design.

> **Note**: Unlike **[Drush][drush]** in a Composer derived project you should **never commit your install dependencies to source control**.

Composer will create `composer.lock` file, which is a list of dependencies that were installed, and in which versions.

> **Note**: In general you should always **commit your `composer.lock` file to source control** so that others via a quick `composer install` can have everything installed along with the correct versions specified in the `composer.lock` file.

### How to update Drupal Core?

Please **don't add `drupal/core` to your project's composer.json** since WxT manages Drupal Core for you along with the series of patches on top of it.

WxT's minor versions will always correspond to Drupal Core's. For example, `drupalwxt/wxt:~4.2.0` will require Drupal Core 9.2.x and `drupalwxt/wxt:~4.1.0` will require Drupal Core 9.1.x.

When you need to update Drupal Core as an example from 9.1.x to 9.2.x, all you would do is change your requirement for `drupalwxt/wxt` in your `composer.json` file:

```
composer require --no-update drupalwxt/wxt:~4.2.0
composer update
```

### Compatibility table

| `drupalwxt/wxt` version | Drupal Core version | Drush version |
| ----------------------- | ------------------- | ------------- |
| `~4.2.0`                | 9.2.x               | `>=9.7`       |
| `~4.1.0`                | 9.1.x               | `>=9.7`       |
| `~4.0.0`                | 8.8.x+              | `>=9.7`       |

## Acknowledgements

Extended with code and lessons learned by the **[Acquia Team][acquia]** over at **[Lightning][lightning]** and **[BLT][blt]**.

<!-- Links Referenced -->

[acquia]:          https://acquia.com
[blt]:             https://github.com/acquia/blt
[composer]:        https://getcomposer.org
[docker-scaffold]: https://github.com/drupalwxt/docker-scaffold.git
[drush]:           https://www.drush.org/latest/
[githubci]:        https://github.com/drupalwxt/site-wxt/actions
[githubci-badge]:  https://github.com/drupalwxt/site-wxt/workflows/build/badge.svg
[lightning]:       https://github.com/acquia/lightning
[node]:            https://nodejs.org
[site-wxt]:        https://github.com/drupalwxt/site-wxt
[readme]:          https://github.com/drupalwxt/wxt/blob/4.2.x/README.md
[wxt]:             https://github.com/drupalwxt/wxt
[wxt-project]:     https://github.com/drupalwxt/wxt-project
