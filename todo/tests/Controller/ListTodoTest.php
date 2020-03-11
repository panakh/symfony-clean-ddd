<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ListTodoTest extends WebTestCase
{
    public function testListTodos()
    {
        $client = static::createClient();
        $client->request('GET', '/todo/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Todo index');
        $this->assertSelectorTextContains('body > a', 'Create new');
    }
}
