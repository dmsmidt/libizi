<?php

/**
 * @file
 * Contains \Triquanta\IziTravel\PurchaseInterface.
 */

namespace Triquanta\IziTravel;

/**
 * Defines a purchase data type.
 */
interface PurchaseInterface extends FactoryInterface {

  /**
   * Gets the price.
   *
   * @return float
   */
  public function getPrice();

  /**
   * Gets the currency code.
   *
   * @return string
   */
  public function getCurrencyCode();

  /**
   * Gets the product ID.
   *
   * @return bool
   */
  public function getProductId();

}