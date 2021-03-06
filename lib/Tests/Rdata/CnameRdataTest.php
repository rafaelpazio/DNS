<?php

/*
 * This file is part of Badcow DNS Library.
 *
 * (c) Samuel Williams <sam@badcow.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Badcow\DNS\Tests\Rdata;

use Badcow\DNS\Rdata\CnameRdata;

class CnameRdataTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \Badcow\DNS\Rdata\RdataException
     * @expectedExceptionMessage The target "3xample.com." is not a Fully Qualified Domain Name
     */
    public function testSetTarget()
    {
        $target = 'foo.example.com.';
        $cname = new CnameRdata();
        $cname->setTarget($target);

        $this->assertEquals($target, $cname->getTarget());

        $cname->setTarget('3xample.com.');
    }

    public function testOutput()
    {
        $target = 'foo.example.com.';
        $cname = new CnameRdata();
        $cname->setTarget($target);

        $this->assertEquals($target, $cname->output());
    }
}
