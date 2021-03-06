<?php

namespace nodespark\DESConnector\Elasticsearch\Aggregations\Bucket;

use nodespark\DESConnector\Elasticsearch\Aggregations\Aggregation;
use nodespark\DESConnector\Elasticsearch\Aggregations\AggregationInterface;

/**
 * Class Bucket.
 *
 * @see https://www.elastic.co/guide/en/elasticsearch/reference/current/search-aggregations-bucket.html
 * @package nodespark\DESConnector\Elasticsearch\Aggregations\Bucket
 */
abstract class Bucket extends Aggregation implements AggregationInterface {
  protected $subAggregations = array();

  /**
   * Construct the aggregation body needed for Elasticsearch.
   */
  public function constructAggregation() {
    $aggregation = parent::constructAggregation();

    // Construct the sub aggregations.
    foreach ($this->subAggregations as $name => $aggregationObj) {
      $aggregation[$this->name]['aggs'] = $aggregationObj->constructAggregation();
    }

    return $aggregation;
  }

  /**
   * Set a sub aggregation.
   *
   * @param AggregationInterface $aggregation
   *   The sub aggregation param.
   */
  public function setSubAggragation(AggregationInterface $aggregation) {
    $this->subAggregations[$aggregation->getName()] = $aggregation;
  }
}