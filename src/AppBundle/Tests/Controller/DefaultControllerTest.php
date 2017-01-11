<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Github Commentator', $crawler->filter('a')->first()->text());
    }

    public function testSearchOK()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
        $form = $crawler->selectButton('Rechercher')->form();

        $form->setValues(array(
            'form[name]' => 'boninir'
        ));


        $client->submit($form);
        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}
