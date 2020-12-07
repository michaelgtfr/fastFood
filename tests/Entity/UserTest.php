<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 01/11/2020
 * Time: 16:19
 */

namespace App\Tests\Entity;


use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserEntity()
    {
        $user = new User();
        $user->setUsername('username test');
        $user->setEmail('emailtest@gmail.com');
        $user->setRoles(['ROLE_USER']);

        $this->assertEquals('username test', $user->getUsername());
        $this->assertEquals('emailtest@gmail.com', $user->getEmail());
        $this->assertEquals(['ROLE_USER'], $user->getRoles());

    }
}