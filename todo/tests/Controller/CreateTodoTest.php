<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CreateTodoTest extends WebTestCase
{
    public function testCreateTodo()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/todo/new');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Create new Todo');
        $form = $crawler->selectButton('Save')->form(
            [
                'todo' => [
                    'description' => 'buy milk',
                    'user' => 1,
                ]
            ]
        );
        $client->followRedirects();
        $client->submit($form);
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Todo index');
        $this->assertSelectorTextContains('body > table > tbody > tr > td:nth-child(2)', 'buy milk');
    }
}
