<?php

namespace Miechuliv\ImageForumBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testHaslaMuszBycTakieSame()
    {
        $client = static::createClient();
        
        $crawler = $client->request('GET','/user/new');
        
        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            
            'miechuliv_imageforumbundle_user[username]'  => 'test_username',
            'miechuliv_imageforumbundle_user[email]'  => 'test@test.pl',
            'miechuliv_imageforumbundle_user[password][first]'  => 'haslo1',
            'miechuliv_imageforumbundle_user[username][second]'  => 'haslo2',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();
        
        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("test_username")')->count(), 'Missing element td:contains("test_username")');
        
    }
    
    /*
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/user/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /user/");
        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'miechuliv_imageforumbundle_user[field_name]'  => 'Test',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Test")')->count(), 'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'miechuliv_imageforumbundle_user[field_name]'  => 'Foo',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="Foo"]')->count(), 'Missing element [value="Foo"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }

    */
}
