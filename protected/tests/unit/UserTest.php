<?php

/**
 * Tests logging a user into the site
 */
class UserTest extends CTestCase
{
    public function testLogin()
    {
        $un = 'sg';
        $pw = 'thenew777';

        $id = new UserIdentity($un, $pw);
        $this->assertTrue($id->authenticate($un, $pw));
    }
}
