<?php

/**
 * @file
 */

namespace Drupal\greatesthits\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a block showing how many hits.
 *
 * @Block(
 * id = "greatesthits_node_report",
 * admin_label = @Translation("GreatestHits count for the current node"),
 * )
 */
class GreatestHitsNodeReportBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $node = \Drupal::routeMatch()->getParameter('node');
    if ($node) {
      global $base_url;
      $config = \Drupal::config('greatesthits.settings');
      $node_url = $base_url . '/node/' . $node->id();
      $query = $config->get('greatesthits_server_baseurl') . '/read?url=' . urlencode($node_url);
      try {
        $response = \Drupal::httpClient()->get($query);
        $response_body = (string) $response->getBody();
        $hits = json_decode($response_body, TRUE);
        $count = count($hits['data']);
        return [
          '#markup' => '<span>' . $count . ' hits</span>',
        ];
      }
      catch (ConnectException $e) {
        $note = t("Sorry, can't connect to GreatestHits server at @server. Please report this!.", ['@server' => $config->get('greatesthits_server_baseurl')]);
        return [
          '#markup' => '<span>' . $note . ' hits</span>',
        ];
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    return 0;
  }

}
