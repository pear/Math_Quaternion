<?php

/**
 * To test Math_Quaternion
 * $Id$
 */

require_once 'Math/QuaternionOp.php';

$a = new Math_Quaternion(2,4,2,-0.5);
$b = new Math_Quaternion(1,2,3,0.5);

echo "a: ".$a->toString()."\n";
echo "b: ".$b->toString()."\n";
$t = Math_QuaternionOp::conjugate($a);
echo "a': ".$t->toString()."\n";
$t = Math_QuaternionOp::conjugate($b);
echo "b': ".$t->toString()."\n";
echo "length(a): ".$a->length()."  length2(a): ".$a->length2()."\n";
echo "real(a): ".$a->getReal()."\nimag(a): ";

print_r($a->getAllIm());

if (!Math_QuaternionOp::areEqual($a, Math_QuaternionOp::negative($a))) {echo "a and neg(a) are different\n";}
$t=Math_QuaternionOp::negative($a);
echo "Neg(a) is ".$t->toString()."\n";
$t=Math_QuaternionOp::conjugate($a);
echo "Conj(a) is ".$t->toString()."\n";
$t=Math_QuaternionOp::inverse($a);
echo "Inv(a) is ".$t->toString()."\n";
$t=Math_QuaternionOp::multReal($a, 1.23);
echo "MultReal(a, 1.23) is ".$t->toString()."\n";

echo "====\n";
$t=Math_QuaternionOp::mult($a,$b);
echo "a*b: ".$t->toString()."\n";
$t=Math_QuaternionOp::mult($b,$a);
echo "b*a: ".$t->toString()."\n";
$t=Math_QuaternionOp::mult($a,Math_QuaternionOp::conjugate($a));
echo "a*a': ".$t->toString()."\n";
echo "length(a*a'): ".$t->length()."\n";
$t=Math_QuaternionOp::add($a,$b);
echo "a+b: ".$t->toString()."\n";
$t=Math_QuaternionOp::sub($a,$b);
echo "a-b: ".$t->toString()."\n";
$t=Math_QuaternionOp::sub($b,$a);
echo "b-a: ".$t->toString()."\n";
$t=Math_QuaternionOp::sub($b,Math_QuaternionOp::conjugate($a));
echo "b-a': ".$t->toString()."\n";
$t=Math_QuaternionOp::sub(Math_QuaternionOp::conjugate($b), $a);
echo "b'-a: ".$t->toString()."\n";
$t=Math_QuaternionOp::sub(Math_QuaternionOp::conjugate($b), Math_QuaternionOp::conjugate($a));
echo "b'-a': ".$t->toString()."\n";
$t = Math_QuaternionOp::div($a, $b);
echo "a/b: ".$t->toString()."\n";
$t = Math_QuaternionOp::div($b, $a);
echo "b/a: ".$t->toString()."\n";
?>
