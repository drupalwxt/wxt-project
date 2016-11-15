<?php

/**
 * @file
 * Contains \DrupalWxT\WxT\ScriptHandler.
 */

namespace DrupalWxT\WxT;

use Composer\Script\Event;
use Composer\Util\ProcessExecutor;

class ScriptHandler {

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

}
