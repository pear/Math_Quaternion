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

include_once 'PEAR.php';
include_once 'Math/Quaternion.php';

/**
 * Math_QuaternionOp: class that implements operations on quaternions
 *
 * Originally this class was part of NumPHP (Numeric PHP package)
 *
 * @author  Jesus M. Castagnetto <jmcastagnetto@php.net>
 * @version 0.9
 * @access  public
 * @package Math_Quaternion
 */

class Math_QuaternionOp {/*{{{*/

	/* is q1 a quaternion? */
	function isQuaternion (&$q1) {/*{{{*/
		if (function_exists('is_a')) {
			return is_a($q1, 'math_quaternion');
		} else {
			return (get_class($q1) == 'math_quaternion' 
			        || is_subclass_of($q1, 'math_quaternion'));
		}
	}/*}}}*/

	/* Q = conj(q1) */
	function &conjugate (&$q1) {/*{{{*/
		if (!Math_QuaternionOp::isQuaternion($q1)) {
			return PEAR::raiseError("Parameter needs to be a quaternion object");
		}
		$q2 = $q1->clone();
		$q2->conjugate();
		return $q2;
	}/*}}}*/
		
	/* Q = -q1 */
	function &negative (&$q1) {/*{{{*/
		if (!Math_QuaternionOp::isQuaternion($q1)) {
			return PEAR::raiseError("Parameter needs to be a quaternion object");
		}
		$q2 = $q1->clone();
		$q2->negate();
		return $q2;
	}/*}}}*/

	/* Q = 1/q1 */
	function &inverse (&$q1) {/*{{{*/
		if (!Math_QuaternionOp::isQuaternion($q1)) {
			return PEAR::raiseError("Parameter needs to be a quaternion object");
		}
		$c = Math_QuaternionOp::conjugate($q1);
		$norm = $q1->norm();
		if ($norm == 0) {
			return PEAR::raiseError('Quaternion norm is zero, cannot calculate inverse');
		}
		$invmult = 1/$norm;
		return Math_QuaternionOp::multReal($c, $invmult);
	}/*}}}*/

	function areEqual (&$q1, &$q2) {/*{{{*/
		if (!Math_QuaternionOp::isQuaternion($q1) || !Math_QuaternionOp::isQuaternion($q2)) {
			return PEAR::raiseError("Parameters need to be quaternion objects");
		}
		return ( $q1->getReal() == $q2->getReal() && $q1->getI() == $q2->getI() &&
				 $q1->getJ() == $q2->getJ() && $q1->getK() == $q2->getK() );
	}/*}}}*/

	function &add (&$q1, &$q2) {/*{{{*/
		if (!Math_QuaternionOp::isQuaternion($q1) || !Math_QuaternionOp::isQuaternion($q2)) {
			return PEAR::raiseError("Parameters need to be quaternion objects");
		}
		return 	new Math_Quaternion( $q1->getReal() + $q2->getReal(), $q1->getI() + $q2->getI(), 
								$q1->getJ() + $q2->getJ(), $q1->getK() + $q2->getK() );
	}/*}}}*/

	function &sub (&$q1, &$q2) {/*{{{*/
		if (!Math_QuaternionOp::isQuaternion($q1) || !Math_QuaternionOp::isQuaternion($q2)) {
			return PEAR::raiseError("Parameters need to be quaternion objects");
		}
		return Math_QuaternionOp::add($q1, Math_QuaternionOp::negative($q2));
	}/*}}}*/

	function &mult (&$q1, &$q2) {/*{{{*/
		if (!Math_QuaternionOp::isQuaternion($q1) || !Math_QuaternionOp::isQuaternion($q2)) {
			return PEAR::raiseError("Parameters need to be quaternion objects");
		}
		// uses the fast multiplication algorithm
		$a = $q1->getReal(); $q1im = $q2->getAllIm();
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

	function &div (&$q1, &$q2) {/*{{{*/
		if (!Math_QuaternionOp::isQuaternion($q1) || !Math_QuaternionOp::isQuaternion($q2)) {
			return PEAR::raiseError("Parameters need to be quaternion objects");
		}
		$i2 = Math_QuaternionOp::inverse($q2);
		if (PEAR::isError($i2)) {
			return $i2;
		}
		return Math_QuaternionOp::mult($i2, $q1);
	}/*}}}*/

	function &multReal (&$q1, $realnum) {/*{{{*/
		if (!Math_QuaternionOp::isQuaternion($q1) || !is_numeric($realnum)) {
			return PEAR::raiseError("A quaternion object and a real number are needed");
		}
		return new Math_Quaternion ( $realnum * $q1->getReal(), $realnum * $q1->getI(),
								$realnum * $q1->getJ(), $realnum * $q1->getK() );
	}/*}}}*/

}/*}}} end of Math_QuaternionOp */
?>

