<?php

namespace App\Tests\Controller;

use Mockery\Exception;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Panther\PantherTestCase;

class CreateTodoTest extends PantherTestCase
{
    public function testCreateTodo()
    {
        $client = static::createPantherClient();
        $crawler = $client->request('GET', '/todo/new');
        $this->assertSelectorTextContains('h1', 'Create new Todo');
        $client->submitForm('Save',
            [
                'todo[description]' => 'buy milk',
                'todo[user]' => 1,
            ]
        );
        $this->assertSelectorTextContains('h1', 'Todo index');
        $this->assertSelectorTextContains('body > table > tbody > tr > td:nth-child(2)', 'buy milk');
        $client->clickLink('show');
        $client->executeScript("document.querySelector('button').click()");
        $client->getWebDriver()->switchTo()->alert()->accept();
    }
}
