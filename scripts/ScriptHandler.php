<?php

namespace DrupalWxT\WxT;

use Composer\Package\RootPackage;
use Composer\Factory;
use Composer\Script\Event;
use Composer\Semver\Comparator;
use Composer\Util\ProcessExecutor;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class ScriptHandler {

  /**
   * Retrieves the Drupal root directory.
   *
   * @param string $project_root
   *   Drupal root directory.
   */
  protected static function getDrupalRoot($project_root) {
    return $project_root . '/html';
  }

  /**
   * Creates the required directory structure.
   *
   * @param \Composer\Script\Event $event
   *   The script event.
   */
  public static function createRequiredFiles(Event $event) {
    $fs = new Filesystem();
    $root = static::getDrupalRoot(getcwd());
    $dirs = [
      'modules',
      'profiles',
      'themes',
    ];

    // Required for unit testing.
    foreach ($dirs as $dir) {
      if (!$fs->exists($root . '/' . $dir)) {
        $fs->mkdir($root . '/' . $dir);
        $fs->touch($root . '/' . $dir . '/.gitkeep');
      }
    }

    // Prepare the settings file for installation.
    if (!$fs->exists($root . '/sites/default/settings.php') and $fs->exists($root . '/sites/default/default.settings.php')) {
      $fs->copy($root . '/sites/default/default.settings.php', $root . '/sites/default/settings.php');
      $fs->chmod($root . '/sites/default/settings.php', 0666);
      $event->getIO()->write("Create a sites/default/settings.php file with chmod 0666");
    }

    // Prepare the services file for installation.
    if (!$fs->exists($root . '/sites/default/services.yml') and $fs->exists($root . '/sites/default/default.services.yml')) {
      $fs->copy($root . '/sites/default/default.services.yml', $root . '/sites/default/services.yml');
      $fs->chmod($root . '/sites/default/services.yml', 0666);
      $event->getIO()->write("Create a sites/default/services.yml file with chmod 0666");
    }

    // Create the files directory with chmod 0777.
    if (!$fs->exists($root . '/sites/default/files')) {
      $oldmask = umask(0);
      $fs->mkdir($root . '/sites/default/files', 0777);
      umask($oldmask);
      $event->getIO()->write("Create a sites/default/files directory with chmod 0777");
    }

    // Rename Chosen to minified asset.
    if ($fs->exists($root . '/libraries/chosen/chosen.jquery.js') and $fs->exists($root . '/libraries/chosen/chosen.css')) {
      $fs->copy($root . '/libraries/chosen/chosen.jquery.js', $root . '/libraries/chosen/chosen.jquery.min.js');
      $fs->copy($root . '/libraries/chosen/chosen.css', $root . '/libraries/chosen/chosen.min.css');
    }
  }

  /**
   * Checks if the installed version of Composer is compatible.
   *
   * Composer 1.0.0 and higher consider a `composer install` without having a
   * lock file present as equal to `composer update`. We do not ship with a lock
   * file to avoid merge conflicts downstream, meaning that if a project is
   * installed with an older version of Composer the scaffolding of Drupal will
   * not be triggered. We check this here instead of in drupal-scaffold to be
   * able to give immediate feedback to the end user, rather than failing the
   * installation after going through the lengthy process of compiling and
   * downloading the Composer dependencies.
   *
   * @see https://github.com/composer/composer/pull/5035
   */
  public static function checkComposerVersion(Event $event) {
    $composer = $event->getComposer();
    $io = $event->getIO();
    $version = $composer::VERSION;
    // The dev-channel of composer uses the git revision as version number,
    // try to the branch alias instead.
    if (preg_match('/^[0-9a-f]{40}$/i', $version)) {
      $version = $composer::BRANCH_ALIAS_VERSION;
    }
    // If Composer is installed through git we have no easy way to determine if
    // it is new enough, just display a warning.
    if ($version === '@package_version@' || $version === '@package_branch_alias_version@') {
      $io->writeError('<warning>You are running a development version of Composer. If you experience problems, please update Composer to the latest stable version.</warning>');
    }
    elseif (Comparator::lessThan($version, '1.0.0')) {
      $io->writeError('<error>Drupal-project requires Composer version 1.0.0 or higher. Please update your Composer before continuing</error>.');
      exit(1);
    }
  }

  /**
   * Deploys front-end related libraries to WxT's install profile directory.
   *
   * @param \Composer\Script\Event $event
   *   The script event.
   */
  public static function deployLibraries(Event $event) {
    $extra = $event->getComposer()->getPackage()->getExtra();
    if (isset($extra['installer-paths'])) {
      foreach ($extra['installer-paths'] as $path => $criteria) {
        if (array_intersect(['drupal/wxt', 'type:drupal-profile'], $criteria)) {
          $wxt = $path;
        }
      }
      if (isset($wxt)) {
        $wxt = str_replace('{$name}', 'wxt', $wxt);
        $executor = new ProcessExecutor($event->getIO());
        $output = NULL;
        $executor->execute('npm run deploy-libraries', $output, $wxt);
      }
    }
  }

  /**
   * Post create project script.
   *
   * @param \Composer\Script\Event $event
   *   The script event.
   */
  public static function postCreateProject(Event $event) {
    $composer = $event->getComposer();
    $composerFile = Factory::getComposerFile();
    $io = $event->getIO();
    $name = $composer->getPackage()->getName();

    $projDir = realpath(dirname($composerFile));
    $projectName = $io->ask('Enter composer project name (drupalwxt/site-wxt): ', 'drupalwxt/site-wxt');

    $finder = new Finder();
    foreach ($finder->files()->name('/composer\.(json|lock)/i')->in($projDir) as $file) {
      if (!empty($projectName)) {
        $file_contents = str_replace("$name", $projectName, $file->getContents());
        file_put_contents($file->getRealPath(), $file_contents);
        // reset the project name via reflection.
        $package = $composer->getPackage();
        $refl = new \ReflectionProperty(get_class($package), 'name');
        $refl->setAccessible(true);
        $refl->setValue($package, $projectName);
      }
    }

  }

}
