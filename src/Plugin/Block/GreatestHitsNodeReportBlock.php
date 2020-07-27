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
 * admin_label = @Translation("GreatestHits for nodes"),
 * )
 */
class GreatestHitsNodeReportBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $node = \Drupal::routeMatch()->getParameter('node');
    if ($node) {
      $node_url = 'http://localhost:8000/node/' . $node->id();
      $query = 'http://10.0.2.2:3000/read?url=' . urlencode($node_url);
      $response = \Drupal::httpClient()->get($query);
      $response_body = (string) $response->getBody();
      $hits = json_decode($response_body, TRUE);
      $count = count($hits['data']);
      return [
        '#markup' => '<span>' . $count . ' hits</span>',
      ];
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    return 0;
  }

}
