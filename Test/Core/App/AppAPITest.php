<?php
/**
 * This file is part of FacturaScripts
 * Copyright (C) 2017-2018    Carlos Garcia Gomez  <carlos@facturascripts.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

namespace FacturaScripts\Test\Core\App;

use FacturaScripts\Core\App\AppAPI;
use FacturaScripts\Core\App\AppSettings;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-07-19 at 11:57:23.
 */
class AppAPITest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AppAPI
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new AppAPI();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    public function testConnect()
    {
        $this->assertTrue($this->object->connect());
    }

    /**
     * @covers \FacturaScripts\Core\App\AppAPI::run
     */
    public function testRun()
    {
        $mustRun = ('true' == AppSettings::get('default', 'enable_api', false));
        $this->assertEquals($this->object->run(), $mustRun);
    }
}
