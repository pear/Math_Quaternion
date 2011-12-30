<?php
require_once 'PHPUnit/Framework/TestCase.php';
require_once 'Math/QuaternionOp.php';

class Math_QuaternionTest extends PHPUnit_Framework_TestCase {


    public function testChauWenTsengData() {
        // Using the data by Chau-Wen Tseng
        // http://www.cs.umd.edu/Outreach/hsContest99/questions/node6.html

        $fmt = 'vector';

        //
        // Test 1
        //
        ob_start();
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
        $result = ob_get_clean();

        ob_start();
?>
* Test 1:
q0 = [ 1 1 0 0 ]
q1 = [ 1 0 1 0 ]
q2 = q0 + q1 = [ 2 1 1 0 ]
q9 = q0 * q1 = [ 1 1 1 1 ]
q9 = -q1 = [ -1 -0 -1 -0 ]

* Test 2:
q0 = [ 1 0.5 0 0 ]
q1 = [ 1 -1 0 0 ]
q2 = [ 0 0 1 0 ]
q3 = [ 0 0 0 1 ]
q3 = -q3 = [ -0 -0 -0 -1 ]
q6 = q2 + q3 = [ 0 0 1 -1 ]
q4 = q0 * q1 = [ 1.5 -0.5 0 0 ]
q4 = q4 * q0 = [ 1.75 0.25 0 0 ]

* Test 3:
q1 = [ 1 2 3 1 ]
q2 = [ 2 1 0 1 ]
q5 = [ 1 2 0 3 ]
q4 = q1 * q2 = [ -1 8 5 0 ]
q3 = q1 * q5 = [ -6 13 -1 -2 ]
q8 = q1 + q3 = [ -5 15 2 -1 ]
q8 = -q8 = [ 5 -15 -2 1 ]
q8 = -q8 = [ -5 15 2 -1 ]

* Test 4:
q0 = [ 1 1 1 1 ]
q1 = [ 4 3 2 1 ]
q2 = -q0 = [ -1 -1 -1 -1 ]
q3 = q1 * q2 = [ 2 -8 -4 -6 ]
q4 = q2 * q3 = [ -20 8 4 0 ]
q5 = q3 * q4 = [ 40 200 40 120 ]
q6 = q4 + q5 = [ 20 208 44 120 ]
q7 = -q6 = [ -20 -208 -44 -120 ]
q8 = q5 + q7 = [ 20 -8 -4 0 ]
q9 = q7 + q8 = [ 0 -216 -48 -120 ]

* Test 5:
q0 = [ 1 2 1 -1 ]
q1 = [ 0 0 0 0 ]
q2 = q0 + q1 = [ 1 2 1 -1 ]
q1 = q2 * q0 = [ -5 4 2 -2 ]
q2 = negate(a) = [ -1 -2 -1 1 ]
q1 = q2 * q0 = [ 5 -4 -2 2 ]
q3 = [ -1 1 0 0 ]
q4 = [ 1 -1 0 0 ]
q5 = q3 * q4 = [ 0 2 0 0 ]
q5 = -q5 = [ -0 -2 -0 -0 ]
q5 = q5 * q5 = [ -4 0 0 0 ]
q5 = q5 * q5 = [ 16 0 0 0 ]
q5 = q5 * q5 = [ 256 0 0 0 ]

* Test 6:
q8 = [ 1.22 -1.84 -0.32 -3.21 ]
q7 = [ -0.82 -0.51 1.51 1.13 ]
q3 = [ 1.28 -3.52 -3.14 -4.84 ]
q2 = [ -0.74 -0.25 -4.39 -8.22 ]
q5 = [ -2.28 -1.19 2.84 -2.34 ]
q1 = [ 1.1 -0.58 -9.53 7.27 ]
q6 = [ -4.63 -3.54 8.94 -2.28 ]
q9 = [ -0.13 -0.32 -1.04 8.49 ]
q4 = [ -8.39 -9.27 8.01 4.03 ]
q0 = [ -7.43 -0.14 -5.24 -7.01 ]
q0 = q0 * q1 = [ -7.2287 -100.7447 70.1275 -63.4321 ]
q1 = q1 * q2 = [ 16.9637 110.4061 -4.3619 -14.2581 ]
q8 = q9 * q8 = [ 26.1727 5.904 -17.876 8.9639 ]
q6 = q7 * q6 = [ -8.9318 -8.2809 -19.4851 -2.5763 ]
<?php
        $expected = ob_get_clean();


        $this->assertSame($expected, $result);
    }



    public function test() {
        ob_start();
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

        if (!Math_QuaternionOp::areEqual($a, Math_QuaternionOp::negate($a))) {echo "a and neg(a) are different\n";}
        $t=Math_QuaternionOp::negate($a);
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
        $result = ob_get_clean();

        ob_start();
?>
a: 2 + 4i + 2j + -0.5k
b: 1 + 2i + 3j + 0.5k
a': 2 + -4i + -2j + 0.5k
b': 1 + -2i + -3j + -0.5k
length(a): 4.9244289008981  length2(a): 24.25
real(a): 2
imag(a): Array
(
    [i] => 4
    [j] => 2
    [k] => -0.5
)
a and neg(a) are different
Neg(a) is -2 + -4i + -2j + 0.5k
Conj(a) is 2 + -4i + -2j + 0.5k
Inv(a) is 0.40613846605345 + -0.8122769321069i + -0.40613846605345j + 0.10153461651336k
MultReal(a, 1.23) is 2.46 + 4.92i + 2.46j + -0.615k
====
a*b: -11.75 + 10.5i + 5j + 8.5k
b*a: -11.75 + 5.5i + 11j + -7.5k
a*a': 24.25 + 0i + 0j + 0k
length(a*a'): 24.25
a+b: 3 + 6i + 5j + 0k
a-b: 1 + 2i + -1j + -1k
b-a: -1 + -2i + 1j + 1k
b-a': -1 + 6i + 5j + 0k
b'-a: -1 + -6i + -5j + 0k
b'-a': -1 + 2i + -1j + -1k
a/b: 4.1722769247549 + 0.66226617853252i + -1.8543452998911j + 1.7218920641846k
b/a: 3.1983404201709 + -0.50767308256681i + 1.4214846311871j + -1.3199500146737k
<?php
        $expected = ob_get_clean();

        $this->assertSame($expected, $result);
    }

}

