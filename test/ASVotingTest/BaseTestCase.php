<?php

namespace ASVotingTest;

use ASVoting\Repo\VotingMotionStorage\DoctrineVotingMotionStorage;
use PHPUnit\Framework\TestCase;


/**
 * Class BaseTestCase
 *
 * Allows checking that no code has output characters, or left the output buffer in a bad state.
 *
 */
class BaseTestCase extends TestCase
{
    /**
     * @var \Auryn\Injector
     */
    protected $injector;

    private $startLevel = null;

    public function setup()
    {
        $this->startLevel = ob_get_level();
        ob_start();
        $this->injector = createInjector();
    }

    public function create(string $classname)
    {
        return $this->injector->make($classname);
    }

    public function teardown()
    {
        if ($this->startLevel === null) {
            $this->assertEquals(0, 1, "startLevel was not set, cannot complete teardown");
        }
        $contents = ob_get_contents();
        ob_end_clean();

        $endLevel = ob_get_level();
        $this->assertEquals($endLevel, $this->startLevel, "Mismatched ob_start/ob_end calls....somewhere");
        $this->assertEquals(
            0,
            strlen($contents),
            "Something has directly output to the screen: [".substr($contents, 0, 50)."]"
        );
    }

    public function testPHPUnitApparentlyGetsConfused()
    {
        //Basically despite having:
        //<exclude>*/BaseTestCase.php</exclude>
        //in the phpunit.xml file it still thinks this file is a test class.
        //and then complains about it not having any tests.
        $this->assertTrue(true);
    }

    public function assertEpsilonEquals(float $expected, float $actual, $message = null)
    {
        if ($message === null) {
            $message = "Value [$actual] is not close enough to expected value of [$expected]";
        }

        $okay = true;
        if (abs($expected - $actual) >  0.000001) {
            $okay = false;
        }

        $this->assertTrue($okay, $message);
    }


    public function assertWithinOneSecord(
        \DateTimeImmutable $expectedTime,
        \DateTimeImmutable $actualTime
    ) {
        $timeDifference = $expectedTime->diff($actualTime);

        $this->assertSame(0, $timeDifference->y, 'Time difference is years out');
        $this->assertSame(0, $timeDifference->m, 'Time difference is months out');
        $this->assertSame(0, $timeDifference->d, 'Time difference is days out');
        $this->assertSame(0, $timeDifference->h, 'Time difference is hours out');
        $this->assertSame(0, $timeDifference->i, 'Time difference is minutes out');

        $this->assertSame(0, $timeDifference->s);
//        $this->assertLessThanOrEqual(1, $timeDifference->s);
    }
}
