<?php
//
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2002 The PHP Group                                |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the PHP license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available at through the world-wide-web at                           |
// | http://www.php.net/license/2_02.txt.                                 |
// | If you did not receive a copy of the PHP license and are unable to   |
// | obtain it through the world-wide-web, please send a note to          |
// | license@php.net so we can mail you a copy immediately.               |
// +----------------------------------------------------------------------+
// | Authors: Jesus M. Castagnetto <jmcastagnetto@php.net>                |
// +----------------------------------------------------------------------+
//
// $Id$
//

include_once "PEAR.php";

/**
 * Math_Quaternion: class to represent an manipulate quaternions (q = a + b*i + c*j + d*k)
 *
 * A quaternion is an extension of the idea of complex numbers
 * In 1844 Hamilton described a system in which numbers were composed of
 * a real part and 3 imaginary and independent parts (i,j,k), such that:
 *
 *     i^2 = j^2 = k^2 = -1       and
 *     ij = k, jk = i, ki = j     and
 *     ji = -k, kj = -i, ik = -j
 *
 * The above are known as "Hamilton's rules"
 *
 * Interesting references on quaternions:
 *
 * - Sir William Rowan Hamilton "On Quaternions", Proceedings of the Royal Irish Academy, 
 *   Nov. 11, 1844, vol. 3 (1847), 1-16 
 *   (http://www.maths.tcd.ie/pub/HistMath/People/Hamilton/Quatern2/Quatern2.html)
 *
 * - Quaternion (from MathWorld): http://mathworld.wolfram.com/Quaternion.html
 * 
 * Originally this class was part of NumPHP (Numeric PHP package)
 *
 * @author  Jesus M. Castagnetto <jmcastagnetto@php.net>
 * @version 0.9
 * @access  public
 * @package Math_Quaternion
 */
class Math_Quaternion {/*{{{*/

	/**
	 * The real part of the quaternion
	 *
	 * @var	float
	 * @access private
	 */
	var $real;

	/**
	 * Coefficient of the first imaginary root
	 *
	 * @var float
	 * @access private
	 */
	var $i;

	/**
	 * Coefficient of the second imaginary root
	 *
	 * @var float
	 * @access private
	 */
	var $j;

	/**
	 * Coefficient of the third imaginary root
	 *
	 * @var float
	 * @access private
	 */
	var $k;
	
	/**
	 * Constructor for Math_Quaternion
	 *
	 * @param float $real
	 * @param float $i
	 * @param float $j
	 * @param float $k
	 * @return object Math_Quaternion
	 * @access public
	 */
	function Math_Quaternion ($real, $i, $j, $k) {/*{{{*/
		$this->setReal($real);
		$this->setI($i);
		$this->setJ($j);
		$this->setK($k);
	}/*}}}*/
	
	/**
	 * Simple string representation of the quaternion
	 *
	 * @return string
	 * @access public
	 */
	function toString () {/*{{{*/
		return ( $this->getReal()." + ".$this->getI()."i + ".
		         $this->getJ()."j + ".$this->getK()."k");
	}/*}}}*/

	/**
	 * Returns the square of the norm (length)
	 *
	 * @return float
	 * @access public
	 */
	function length2() {/*{{{*/
			$r = $this->getReal(); 
			$i = $this->getI();
			$j = $this->getJ(); 
			$k = $this->getK();
			return ($r*$r + $i*$i + $j*$j + $k*$k);
	}/*}}}*/

	/**
	 * Returns the norm of the quaternion
	 *
	 * @return float
	 * @access public
	 */
    function norm() {
		return sqrt($this->length2());
	}
	
	/**
	 * Returns the length (norm). Alias of Math_Quaternion:norm()
	 *
	 * @return float
	 * @access public
	 */
	function length() {
		return $this->norm();
	}

	/**
	 * Normalizes the quaternion
	 *
	 * @return mixed True on success, PEAR_Error object otherwise
	 * @access public
	 */
	function normalize() {/*{{{*/
		$n = $this->norm();
		if ($n == 0.0) {
			return PEAR::raiseError('Quaternion cannot be normalized, norm = 0');
		} else {
			$this->setReal($this->getReal() / $n);
			$this->setI($this->getI() / $n);
			$this->setJ($this->getJ() / $n);
			$this->setK($this->getK() / $n);
			if ($this->norm() != 1.0) {
				return PEAR_Error('Computation error while normalizing, norm != 1');
			} else {
				return true;
			}
		}
	}/*}}}*/

	/**
	 * Conjugates the quaternion
	 *
	 * @return void
	 * @access public
	 */
	function conjugate() {
		$this->setI(-1 * $this->getI());
		$this->setJ(-1 * $this->getJ());
		$this->setK(-1 * $this->getK());
	}

	/**
	 * Negates the quaternion
	 *
	 * @return void
	 * @access public
	 */
	function negate() {
		$this->setReal(-1 * $this->getReal());
		$this->setI(-1 * $this->getI());
		$this->setJ(-1 * $this->getJ());
		$this->setK(-1 * $this->getK());
	}

	/**
	 * Clones the quaternion
	 *
	 * @return object Math_Quaternion
	 * @access public
	 */
	function &clone() {
		return new Math_Quaternion($this->getReal(), $this->getI(), $this->getJ(), $this->getK());
	}

	/**
	 * Sets the real part
	 *
	 * @param float $real
	 * @return void
	 * @access public
	 */
	function setReal($real) {/*{{{*/
		$this->real = floatval($real);
	}/*}}}*/
	
	/**
	 * Returns the real part
	 *
	 * @return float
	 * @access public
	 */
	function getReal() {/*{{{*/
		return $this->real;
	}/*}}}*/

	/**
	 * Sets I
	 *
	 * @param float $i
	 * @return void
	 * @access public
	 */
	function setI($i) {/*{{{*/
		$this->i = floatval($i);
	}/*}}}*/
	
	/**
	 * Returns I
	 *
	 * @return float
	 * @access public
	 */
	function getI() {/*{{{*/
		return $this->i;
	}/*}}}*/

	/**
	 * Sets J
	 *
	 * @param float $j
	 * @return void
	 * @access public
	 */
	function setJ($j) {/*{{{*/
		$this->j = floatval($j);
	}/*}}}*/
	
	/**
	 * Returns J
	 *
	 * @return float
	 * @access public
	 */
	function getJ() {/*{{{*/
		return $this->j;
	}/*}}}*/

	/**
	 * Sets K
	 *
	 * @param float $k
	 * @return void
	 * @access public
	 */
	function setK($k) {/*{{{*/
		$this->k = floatval($k);
	}/*}}}*/
	
	/**
	 * Returns K
	 *
	 * @return float
	 * @access public
	 */
	function getK() {/*{{{*/
		return $this->k;
	}/*}}}*/

	/**
	 * Sets I, J, K
	 * @return void
	 * @access public
	 */
	function setAllIm($i, $j, $k) {/*{{{*/
		$this->setI($i);
		$this->setJ($j);
		$this->setK($k);
	}/*}}}*/
	
	/**
	 * Returns an associative array of I, J, K
	 *
	 * @return array
	 * @access public
	 */
	function getAllIm() {/*{{{*/
		return array ( 'i' => $this->getI(), 'j' => $this->getJ(), 'k' => $this->getK() );
	}/*}}}*/

}/*}}} end of Math_Quaternion */

?>

