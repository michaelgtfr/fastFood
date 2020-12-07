<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 31/10/2020
 * Time: 17:32
 */

namespace App\Tests\Form;


use App\Entity\Contact;
use App\Form\ContactForm;
use Symfony\Component\Form\Test\TypeTestCase;

class ContactFormTest extends TypeTestCase
{
    /**
     * ContactForm file test file. Tested with phpunit "./vendor/bin/simple-phpunit"
     */
    public function testBuildForm()
    {
        $data = [
            'title' => 'test',
            'email' => 'testEmail@gmail.com',
            'content' => 'content test',
        ];

        $contact = new Contact();

        $formContact = $this->factory->create(ContactForm::class, $contact);

        $dataToCompare = new Contact();
        $dataToCompare->setContent($data['content']);
        $dataToCompare->setTitle($data['title']);
        $dataToCompare->setEmail($data['email']);

        $formContact->submit($data);

        $this->assertTrue($formContact->isSynchronized());

        $this->assertEquals($contact->getTitle(), $dataToCompare->getTitle());
        $this->assertEquals($contact->getContent(), $dataToCompare->getContent());
        $this->assertEquals($contact->getemail(), $dataToCompare->getemail());

        $view = $formContact->createView();
        $children = $view->children;

        foreach (array_keys($data) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
