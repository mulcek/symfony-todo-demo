<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskControllerTest extends WebTestCase
{
    
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/task/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /task/");
        $crawler = $client->click($crawler->selectLink('New task')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'appbundle_task[name]'  => 'Test task',
            'appbundle_task[description]'  => 'Detailed description',
            'appbundle_task[startTime][date][month]'    => 1,
            'appbundle_task[startTime][date][day]'      => 1,
            'appbundle_task[startTime][date][year]'     => 2017,
            'appbundle_task[startTime][time][hour]'     => 12,
            'appbundle_task[startTime][time][minute]'   => 0,
            'appbundle_task[endTime][date][month]'      => 1,
            'appbundle_task[endTime][date][day]'        => 1,
            'appbundle_task[endTime][date][year]'       => 2017,
            'appbundle_task[endTime][time][hour]'       => 14,
            'appbundle_task[endTime][time][minute]'     => 0,
            'appbundle_task[user]'  => 1,
        ));

        $client->submit($form);
//        echo $client->getResponse()->getContent();die;// Just add this line
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Test task")')->count(), 'Missing element td:contains("Test task")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());
        $form = $crawler->selectButton('Edit')->form(array(
            'appbundle_task[user]'  => 2,
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="2"]')->count(), 'Missing element [value="2"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Test[ ]task/', $client->getResponse()->getContent());
    }
}
