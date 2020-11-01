<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 01/11/2020
 * Time: 11:12
 */

namespace App\Tests\Entity;


use App\Entity\Contact;
use PHPUnit\Framework\TestCase;

class ContactTest extends TestCase
{
    public function testContactEntity()
    {
        $contact = new Contact();
        $contact->setTitle('title test');
        $contact->setEmail('test@gmail.com');
        $contact->setContent('content test');

        $this->assertEquals('title test', $contact->getTitle());
        $this->assertEquals('test@gmail.com', $contact->getEmail());
        $this->assertEquals('content test', $contact->getContent());
    }
}