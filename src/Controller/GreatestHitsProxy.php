<?php

namespace Drupal\greatesthits\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Exception\ConnectException;

/**
 * GreatestHits Controller.
 */
class GreatestHitsProxy extends ControllerBase {

  /**
   * Route callback.
   *
   * Wha? This controller is called via an asyncronous JavaScript request, and
   * then makes the request to the remote GreatestHits service. In other words,
   * it's a proxy for what should be a direct JavaScript call to the GreatestHits
   * server. For the proof of concept this is way easier than figuring out
   * CORS's arcane rules.
   */
  public function main(Request $request) {
    $query_string = $request->getQueryString();
    if (!empty($query_string)) {
      $config = \Drupal::config('greatesthits.settings');
      parse_str($query_string, $query);
      $greatesthits_url = $config->get('greatesthits_server_baseurl') . '/insert?url=' . urlencode($query['url']) . '&type=' . $query['type'] . '&ip=' . $query['ip'];
      try {
        \Drupal::httpClient()->get($greatesthits_url);
      }
      catch (ConnectException $e) {
        \Drupal::messenger()->addWarning(t("Can't connect to GreatestHits server at @server. Please report this!.", ['@server' => $config->get('greatesthits_server_baseurl')]));
      }
    }

    $response = new Response();
    return $response;
  }

}
