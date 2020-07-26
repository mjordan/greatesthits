<?php

namespace Drupal\greatesthits\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * GreatestHits Controller.
 */
class GreatestHitsProxy extends ControllerBase {

  /**
   * Route callback.
   *
   * Wha? This callback is called via an asyncronous JavaScript request, and
   * then makes the request to the remote GreatestHits service. For the proof
   * of concept this is way easier than figuring out CORS's arcane rules.
   */
  public function main(Request $request) {
    $query_string = $request->getQueryString();
    if (!empty($query_string)) {
      parse_str($query_string, $query);
      $greatesthits_url = 'http://10.0.2.2:3000/insert?url=' . urlencode($query['url']) . '&type=' . $query['type'] . '&ip=' . $query['ip'];
      \Drupal::httpClient()->get($greatesthits_url);
    }

    $response = new Response();
    return $response;
  }

}
