<?php
// $Id$

// Using the data by Chau-Wen Tseng
// http://www.cs.umd.edu/Outreach/hsContest99/questions/node6.html

include_once 'Math/QuaternionOp.php';

$fmt = 'vector';

//
// Test 1
//

$q0 = new Math_Quaternion(1,1,0,0);
$q1 = new Math_Quaternion(1,0,1,0);

echo "* Test 1:\n";
echo 'q0 = '.$q0->toString($fmt)."\n";
echo 'q1 = '.$q1->toString($fmt)."\n";
$q2 = Math_QuaternionOp::add($q0, $q1);
echo 'q2 = q0 + q1 = '.$q2->toString($fmt)."\n";
$q9 = Math_QuaternionOp::mult($q0, $q1);
echo 'q9 = q0 * q1 = '.$q9->toString($fmt)."\n";
$q9 = Math_QuaternionOp::negate($q1);
echo 'q9 = -q1 = '.$q9->toString($fmt)."\n";

//
// Test 2
//

$q0 = new Math_Quaternion(1,0.5,0,0);
$q1 = new Math_Quaternion(1,-1,0,0);
$q2 = new Math_Quaternion(0,0,1,0);
$q3 = new Math_Quaternion(0,0,0,1);

echo "\n* Test 2:\n";
echo 'q0 = '.$q0->toString($fmt)."\n";
echo 'q1 = '.$q1->toString($fmt)."\n";
echo 'q2 = '.$q2->toString($fmt)."\n";
echo 'q3 = '.$q3->toString($fmt)."\n";
$q3->negate();
echo 'q3 = -q3 = '.$q3->toString($fmt)."\n";
$q6 = Math_QuaternionOp::add($q2, $q3);
echo 'q6 = q2 + q3 = '.$q6->toString($fmt)."\n";
$q4 = Math_QuaternionOp::mult($q0, $q1);
echo 'q4 = q0 * q1 = '.$q4->toString($fmt)."\n";
$q4 = Math_QuaternionOp::mult($q4, $q0);
echo 'q4 = q4 * q0 = '.$q4->toString($fmt)."\n";

//
// Test 3
//

$q1 = new Math_Quaternion(1,2,3,1);
$q2 = new Math_Quaternion(2,1,0,1);
$q5 = new Math_Quaternion(1,2,0,3);

echo "\n* Test 3:\n";
echo 'q1 = '.$q1->toString($fmt)."\n";
echo 'q2 = '.$q2->toString($fmt)."\n";
echo 'q5 = '.$q5->toString($fmt)."\n";
$q4 = Math_QuaternionOp::mult($q1, $q2);
echo 'q4 = q1 * q2 = '.$q4->toString($fmt)."\n";
$q3 = Math_QuaternionOp::mult($q1, $q5);
echo 'q3 = q1 * q5 = '.$q3->toString($fmt)."\n";
$q8 = Math_QuaternionOp::add($q1, $q3);
echo 'q8 = q1 + q3 = '.$q8->toString($fmt)."\n";
$q8->negate();
echo 'q8 = -q8 = '.$q8->toString($fmt)."\n";
$q8->negate();
echo 'q8 = -q8 = '.$q8->toString($fmt)."\n";

//
// Test 4
//

$q0 = new Math_Quaternion(1,1,1,1);
$q1 = new Math_Quaternion(4,3,2,1);

echo "\n* Test 4:\n";
echo 'q0 = '.$q0->toString($fmt)."\n";
echo 'q1 = '.$q1->toString($fmt)."\n";
$q2 = Math_QuaternionOp::negate($q0);
echo 'q2 = -q0 = '.$q2->toString($fmt)."\n";
$q3 = Math_QuaternionOp::mult($q1, $q2);
echo 'q3 = q1 * q2 = '.$q3->toString($fmt)."\n";
$q4 = Math_QuaternionOp::mult($q2, $q3);
echo 'q4 = q2 * q3 = '.$q4->toString($fmt)."\n";
$q5 = Math_QuaternionOp::mult($q3, $q4);
echo 'q5 = q3 * q4 = '.$q5->toString($fmt)."\n";
$q6 = Math_QuaternionOp::add($q4, $q5);
echo 'q6 = q4 + q5 = '.$q6->toString($fmt)."\n";
$q7 = Math_QuaternionOp::negate($q6);
echo 'q7 = -q6 = '.$q7->toString($fmt)."\n";
$q8 = Math_QuaternionOp::add($q5, $q7);
echo 'q8 = q5 + q7 = '.$q8->toString($fmt)."\n";
$q9 = Math_QuaternionOp::add($q7, $q8);
echo 'q9 = q7 + q8 = '.$q9->toString($fmt)."\n";

//
// Test 5
//

$q0 = new Math_Quaternion(1,2,1,-1);
$q1 = new Math_Quaternion(0,0,0,0);

echo "\n* Test 5:\n";
echo 'q0 = '.$q0->toString($fmt)."\n";
echo 'q1 = '.$q1->toString($fmt)."\n";
$q2 = Math_QuaternionOp::add($q0, $q1);
echo 'q2 = q0 + q1 = '.$q2->toString($fmt)."\n";
$q1 = Math_QuaternionOp::mult($q2, $q0);
echo 'q1 = q2 * q0 = '.$q1->toString($fmt)."\n";
$q2 = Math_QuaternionOp::negate($q0);
echo 'q2 = negate(a) = '.$q2->toString($fmt)."\n";
$q1 = Math_QuaternionOp::mult($q2, $q0);
echo 'q1 = q2 * q0 = '.$q1->toString($fmt)."\n";
$q3 = new Math_Quaternion(-1,1,0,0);
$q4 = new Math_Quaternion(1,-1,0,0);
echo 'q3 = '.$q3->toString($fmt)."\n";
echo 'q4 = '.$q4->toString($fmt)."\n";
$q5 = Math_QuaternionOp::mult($q3, $q4);
echo 'q5 = q3 * q4 = '.$q5->toString($fmt)."\n";
$q5->negate();
echo 'q5 = -q5 = '.$q5->toString($fmt)."\n";
$q5 = Math_QuaternionOp::mult($q5, $q5);
echo 'q5 = q5 * q5 = '.$q5->toString($fmt)."\n";
$q5 = Math_QuaternionOp::mult($q5, $q5);
echo 'q5 = q5 * q5 = '.$q5->toString($fmt)."\n";
$q5 = Math_QuaternionOp::mult($q5, $q5);
echo 'q5 = q5 * q5 = '.$q5->toString($fmt)."\n";

//
// Test 6
//

echo "\n* Test 6:\n";
$q8 = new Math_Quaternion(1.22,-1.84,-0.32,-3.21);
$q7 = new Math_Quaternion(-0.82,-0.51,1.51,1.13);
$q3 = new Math_Quaternion(1.28,-3.52,-3.14,-4.84);
$q2 = new Math_Quaternion(-0.74,-0.25,-4.39,-8.22);
$q5 = new Math_Quaternion(-2.28,-1.19,2.84,-2.34);
$q1 = new Math_Quaternion(1.10,-0.58,-9.53,7.27);
$q6 = new Math_Quaternion(-4.63,-3.54,8.94,-2.28);
$q9 = new Math_Quaternion(-0.13,-0.32,-1.04,8.49);
$q4 = new Math_Quaternion(-8.39,-9.27,8.01,4.03);
$q0 = new Math_Quaternion(-7.43,-0.14,-5.24,-7.01);

echo 'q8 = '.$q8->toString($fmt)."\n";
echo 'q7 = '.$q7->toString($fmt)."\n";
echo 'q3 = '.$q3->toString($fmt)."\n";
echo 'q2 = '.$q2->toString($fmt)."\n";
echo 'q5 = '.$q5->toString($fmt)."\n";
echo 'q1 = '.$q1->toString($fmt)."\n";
echo 'q6 = '.$q6->toString($fmt)."\n";
echo 'q9 = '.$q9->toString($fmt)."\n";
echo 'q4 = '.$q4->toString($fmt)."\n";
echo 'q0 = '.$q0->toString($fmt)."\n";
$q0 = Math_QuaternionOp::mult($q0, $q1);
echo 'q0 = q0 * q1 = '.$q0->toString($fmt)."\n";
$q1 = Math_QuaternionOp::mult($q1, $q2);
echo 'q1 = q1 * q2 = '.$q1->toString($fmt)."\n";
$q8 = Math_QuaternionOp::mult($q9, $q8);
echo 'q8 = q9 * q8 = '.$q8->toString($fmt)."\n";
$q6 = Math_QuaternionOp::mult($q7, $q6);
echo 'q6 = q7 * q6 = '.$q6->toString($fmt)."\n";

?>
