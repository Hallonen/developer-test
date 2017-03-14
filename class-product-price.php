<?php
error_reporting(0);
ini_set('display_errors', 0);

/**
 * Class to handle products
 *
 * Set and get the various fields of the products
 */
class ProductPrice
{
  public $name; // product name
	public $currency; // product currency
	public $p; // product price
  public $taxP = 25; // tax in percentage
  public $taxA; // tax in amount
	public $fees = array('11338' => 25); // array of productcodes with fees
	
	/**
     * Construct the class with basic data
    */
  function __construct(){
		list( $p, $currency, $name ) = func_get_args();
    $this->name = $name;
    $this->currency = $currency;
		$p = $this->product_fees($p); // add any fees to price
		$this->set_price($p); // set the prices
  }

  /**
   * Sets the price for the product
   * 
   * @param float $p  The price of the product
   * @param float $pp The VAT percentage (default is 25)
   */
  function set_price($p, $pp = 25  ) {
    $this->taxP = $pp;
    $this->taxA = $p * ($pp / 100);
    $this->p = $p;
  }

	/**
     * Checks if fees should be added to the price
     *
     * Extracts the numbers from the name of the product
     * and checks if there are any fees for that product
     * 
     * @param float $p The product price
     *
     * @return float $p the new price
    */
  function product_fees($p) {
    $which = preg_match( '([\d]+)', $this->name, $match); // extract the numbers from the productname
		
    if (array_key_exists($match[0], $this->fees ))
			return $p + $this->fees[$match[0]]; // fees added to the price
		else
			return $p;
  }

	/**
     * Get the price excluding VAT
     *
     * @param float $j quantity of the product
     *
     * @return float price without VAT
    */
  function get_price_excl_tax($j) {
    return $this->p * $j;
  }
	
	/**
     * Get the price including VAT
     *
     * @param float $j quantity of the product
     *
     * @return float price with VAT
    */
	function get_price_incl_tax($j) {
    return ($this->p + $this->taxA) * $j;
  }

	/**
     * Get the price in html format
     *
     * @param float  $qty quantity of products
     * @param string $method name of the method of VAT calculation
    */
  function get_htm_price($qty = 1, $method){
		$htm = '<div id="price">%d</div>';
		printf($htm, call_user_func_array(array($this, $method), [$qty]));
  }
}

?>