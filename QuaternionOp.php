<?php
//
// +----------------------------------------------------------------------+
// | PHP Version 4                                                        |
// +----------------------------------------------------------------------+
// | Copyright (c) 1997-2003 The PHP Group                                |
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

include_once 'PEAR.php';
include_once 'Math/Quaternion.php';

/**
 * Math_QuaternionOp: class that implements operations on quaternions
 *
 * Originally this class was part of NumPHP (Numeric PHP package)
 *
 * Example:
 * <pre>
 * require_once 'Math/QuaternionOp.php';
 * 
 * $a = new Math_Quaternion(2,4,2,-0.5);
 * $b = new Math_Quaternion(1,2,3,0.5);
 * 
 * if (!Math_QuaternionOp::areEqual($a, Math_QuaternionOp::negate($a))) {
 *     echo "a and neg(a) are different\n";
 * }
 * $t=Math_QuaternionOp::negate($a);
 * echo "Neg(a) is ".$t->toString()."\n";
 * $t=Math_QuaternionOp::conjugate($a);
 * echo "Conj(a) is ".$t->toString()."\n";
 * $t=Math_QuaternionOp::inverse($a);
 * echo "Inv(a) is ".$t->toString()."\n";
 * $t=Math_QuaternionOp::multReal($a, 1.23);
 * echo "MultReal(a, 1.23) is ".$t->toString()."\n";
 * 
 * echo "====\n";
 * $t=Math_QuaternionOp::mult($a,$b);
 * echo "a*b: ".$t->toString()."\n";
 * $t=Math_QuaternionOp::mult($b,$a);
 * echo "b*a: ".$t->toString()."\n";
 * $t=Math_QuaternionOp::mult($a,Math_QuaternionOp::conjugate($a));
 * echo "a*a': ".$t->toString()."\n";
 * echo "length(a*a'): ".$t->length()."\n";
 * $t=Math_QuaternionOp::add($a,$b);
 * echo "a+b: ".$t->toString()."\n";
 * $t=Math_QuaternionOp::sub($a,$b);
 * echo "a-b: ".$t->toString()."\n";
 * $t=Math_QuaternionOp::sub($b,$a);
 * echo "b-a: ".$t->toString()."\n";
 * $t=Math_QuaternionOp::sub($b,Math_QuaternionOp::conjugate($a));
 * echo "b-a': ".$t->toString()."\n";
 * $t=Math_QuaternionOp::sub(Math_QuaternionOp::conjugate($b), $a);
 * echo "b'-a: ".$t->toString()."\n";
 * $t=Math_QuaternionOp::sub(Math_QuaternionOp::conjugate($b), Math_QuaternionOp::conjugate($a));
 * echo "b'-a': ".$t->toString()."\n";
 * $t = Math_QuaternionOp::div($a, $b);
 * echo "a/b: ".$t->toString()."\n";
 * $t = Math_QuaternionOp::div($b, $a);
 * echo "b/a: ".$t->toString()."\n";
 * </pre>
 *
 * Output from example:
 * <pre>
 * a and neg(a) are different
 * Neg(a) is -2 + -4i + -2j + 0.5k
 * Conj(a) is 2 + -4i + -2j + 0.5k
 * Inv(a) is 0.40613846605345 + -0.8122769321069i + -0.40613846605345j + 0.10153461651336k
 * MultReal(a, 1.23) is 2.46 + 4.92i + 2.46j + -0.615k
 * ====
 * a*b: -11.25 + 6i + 9j + 1.5k
 * b*a: -18.25 + 12i + 6j + -1.5k
 * a*a': -16.25 + -16i + -8j + 2k
 * length(a*a'): 24.25
 * a+b: 3 + 6i + 5j + 0k
 * a-b: 1 + 2i + -1j + -1k
 * b-a: -1 + -2i + 1j + 1k
 * b-a': -1 + 6i + 5j + 0k
 * b'-a: -1 + -6i + -5j + 0k
 * b'-a': -1 + 2i + -1j + -1k
 * a/b: -19.720187057174 + 9.059625885652i + 4.529812942826j + -1.1324532357065k
 * b/a: -12.843861533947 + 2.8122769321069i + 4.2184153981603j + 0.70306923302672k
 * </pre>
 *
 * @author  Jesus M. Castagnetto <jmcastagnetto@php.net>
 * @version 0.7
 * @access  public
 * @package Math_Quaternion
 */
class Math_QuaternionOp {/*{{{*/

	/**
	 * Whether the object is a Math_Quaternion instance
	 *
	 * @param object Math_Quaternion $q1
	 * @return boolean TRUE if object is a Math_Quaternion, FALSE otherwise
	 * @access public
	 */
	function isQuaternion (&$q1) {/*{{{*/
		if (function_exists('is_a')) {
			return is_a($q1, 'math_quaternion');
		} else {
			return (get_class($q1) == 'math_quaternion' 
			        || is_subclass_of($q1, 'math_quaternion'));
		}
	}/*}}}*/

	/**
	 * Calculate the conjugate of a quaternion
	 *
	 * @param object Math_Quaternion $q1
	 * @return object a Math_Quaternion on success, PEAR_Error otherwise
	 * @access public
	 */
	function &conjugate (&$q1) {/*{{{*/
		if (!Math_QuaternionOp::isQuaternion($q1)) {
			return PEAR::raiseError("Parameter needs to be a Math_Quaternion object");
		}
		$q2 = $q1->clone();
		$q2->conjugate();
		return $q2;
	}/*}}}*/
		
	/**
	 * Negates the given quaternion
	 *
	 * @param object Math_Quaternion $q1
	 * @return object a Math_Quaternion on success, PEAR_Error otherwise
	 * @access public
	 */
	function &negate (&$q1) {/*{{{*/
		if (!Math_QuaternionOp::isQuaternion($q1)) {
			return PEAR::raiseError("Parameter needs to be a Math_Quaternion object");
		}
		$q2 = $q1->clone();
		$q2->negate();
		return $q2;
	}/*}}}*/

	/**
	 * Inverts the given quaternion
	 *
	 * @param object Math_Quaternion $q1
	 * @return object a Math_Quaternion on success, PEAR_Error otherwise
	 * @access public
	 * @see Math_QuaternionOp::multReal
	 */
	function &inverse (&$q1) {/*{{{*/
		if (!Math_QuaternionOp::isQuaternion($q1)) {
			return PEAR::raiseError("Parameter needs to be a Math_Quaternion object");
		}
		$c = Math_QuaternionOp::conjugate($q1);
		$norm = $q1->norm();
		if ($norm == 0) {
			return PEAR::raiseError('Quaternion norm is zero, cannot calculate inverse');
		}
		$invmult = 1/$norm;
		return Math_QuaternionOp::multReal($c, $invmult);
	}/*}}}*/

	/**
	 * Checks if two quaternions represent the same number
	 *
	 * @param object Math_Quaternion $q1
	 * @param object Math_Quaternion $q2
	 * @return mixed PEAR_Error on error, TRUE if q1 == q2, FALSE otherwise
	 * @access public
	 */
	function areEqual (&$q1, &$q2) {/*{{{*/
		if (!Math_QuaternionOp::isQuaternion($q1) || !Math_QuaternionOp::isQuaternion($q2)) {
			return PEAR::raiseError("Parameters need to be Math_Quaternion objects");
		}
		return ( $q1->getReal() == $q2->getReal() && $q1->getI() == $q2->getI() &&
				 $q1->getJ() == $q2->getJ() && $q1->getK() == $q2->getK() );
	}/*}}}*/

	/**
	 * Adds two quaternions: q1 + q2
	 *
	 * @param object Math_Quaternion $q1
	 * @param object Math_Quaternion $q2
	 * @return object a Math_Quaternion on success, PEAR_Error otherwise
	 * @access public
	 */
	function &add (&$q1, &$q2) {/*{{{*/
		if (!Math_QuaternionOp::isQuaternion($q1) || !Math_QuaternionOp::isQuaternion($q2)) {
			return PEAR::raiseError("Parameters need to be Math_Quaternion objects");
		}
		return 	new Math_Quaternion( $q1->getReal() + $q2->getReal(), $q1->getI() + $q2->getI(), 
								$q1->getJ() + $q2->getJ(), $q1->getK() + $q2->getK() );
	}/*}}}*/

	/**
	 * Substracts two quaternions: q1 - q2
	 *
	 * @param object Math_Quaternion $q1
	 * @param object Math_Quaternion $q2
	 * @return object a Math_Quaternion on success, PEAR_Error otherwise
	 * @access public
	 */
	function &sub (&$q1, &$q2) {/*{{{*/
		if (!Math_QuaternionOp::isQuaternion($q1) || !Math_QuaternionOp::isQuaternion($q2)) {
			return PEAR::raiseError("Parameters need to be Math_Quaternion objects");
		}
		return Math_QuaternionOp::add($q1, Math_QuaternionOp::negate($q2));
	}/*}}}*/

	/**
	 * Multiplies two quaternions: q1 * q2
	 * It uses a fast multiplication algorithm.
	 *
	 * @param object Math_Quaternion $q1
	 * @param object Math_Quaternion $q2
	 * @return object a Math_Quaternion on success, PEAR_Error otherwise
	 * @access public
	 */
	function &mult (&$q1, &$q2) {/*{{{*/
		if (!Math_QuaternionOp::isQuaternion($q1) || !Math_QuaternionOp::isQuaternion($q2)) {
			return PEAR::raiseError("Parameters need to be Math_Quaternion objects");
		}
		// uses the fast multiplication algorithm
		$a = $q1->getReal(); $q1im = $q1->getAllIm();
		$b = $q1im["i"]; $c = $q1im["j"]; $d = $q1im["k"];

		$x = $q2->getReal(); $q2im = $q2->getAllIm();
		$y = $q2im["i"]; $z = $q2im["j"]; $w = $q2im["k"];

		$t0 = ($d - $c) * ($z - $w); 
		$t1 = ($a + $b) * ($x + $y);
		$t2 = ($a - $b) * ($z + $w);
		$t3 = ($c + $d) * ($x - $y);
		$t4 = ($d - $b) * ($y - $z);
		$t5 = ($d + $b) * ($y + $z);
		$t6 = ($a + $c) * ($x - $w);
		$t7 = ($a - $c) * ($x + $w);
		$t8 = $t5 + $t6 + $t7;
		$t9 = 0.5 * ($t4 + $t8);
		
		$r = $t0 + $t9 - $t5;
		$i = $t1 + $t9 - $t8;
		$j = $t2 + $t9 - $t7;
		$k = $t3 + $t9 - $t6;

		return new Math_Quaternion($r, $i , $j, $k);
	}/*}}}*/

	/**
	 * Divides two quaternions: q1 / q2
	 *
	 * @param object Math_Quaternion $q1
	 * @param object Math_Quaternion $q2
	 * @return object a Math_Quaternion on success, PEAR_Error otherwise
	 * @access public
	 */
	function &div (&$q1, &$q2) {/*{{{*/
		if (!Math_QuaternionOp::isQuaternion($q1) || !Math_QuaternionOp::isQuaternion($q2)) {
			return PEAR::raiseError("Parameters need to be Math_Quaternion objects");
		}
		$i2 = Math_QuaternionOp::inverse($q2);
		if (PEAR::isError($i2)) {
			return $i2;
		}
		return Math_QuaternionOp::mult($i2, $q1);
	}/*}}}*/

	/**
	 * Multiplies a quaternion by a real number: q1 * realnum
	 *
	 * @param object Math_Quaternion $q1
	 * @param float $realnum
	 * @return object a Math_Quaternion on success, PEAR_Error otherwise
	 * @access public
	 */
	function &multReal (&$q1, $realnum) {/*{{{*/
		if (!Math_QuaternionOp::isQuaternion($q1) || !is_numeric($realnum)) {
			return PEAR::raiseError("A Math_Quaternion object and a real number are needed");
		}
		return new Math_Quaternion ( $realnum * $q1->getReal(), $realnum * $q1->getI(),
								$realnum * $q1->getJ(), $realnum * $q1->getK() );
	}/*}}}*/

}/*}}} end of Math_QuaternionOp */
?>

