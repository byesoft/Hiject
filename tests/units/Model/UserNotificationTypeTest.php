<?php

/*
 * This file is part of Hiject.
 *
 * Copyright (C) 2016 Hiject Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__.'/../Base.php';

use Hiject\Model\UserNotificationTypeModel;

class UserNotificationTypeTest extends Base
{
    public function testGetTypes()
    {
        $nt = new UserNotificationTypeModel($this->container);
        $this->assertEmpty($nt->getTypes());

        $nt->setType('email', 'Email', 'Something');
        $nt->setType('web', 'Web', 'Something');
        $this->assertEquals(array('email' => 'Email', 'web' => 'Web'), $nt->getTypes());
    }

    public function testGetSelectedTypes()
    {
        $nt = new UserNotificationTypeModel($this->container);

        // No type defined
        $this->assertEmpty($nt->getSelectedTypes(1));

        // Hidden type
        $nt->setType('baz', 'Baz', 'Something3', true);
        $this->assertEmpty($nt->getSelectedTypes(1));

        // User defined types but not registered
        $this->assertTrue($nt->saveSelectedTypes(1, array('foo', 'bar')));
        $this->assertEmpty($nt->getSelectedTypes(1));

        // User defined types and registered
        $nt->setType('bar', 'Bar', 'Something4');
        $nt->setType('foo', 'Foo', 'Something3');
        $this->assertEquals(array('bar', 'foo'), $nt->getSelectedTypes(1));
    }
}
