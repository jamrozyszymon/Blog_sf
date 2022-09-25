<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testPostDisplayByCategory()
    {
        $client=static::createClient();
        $crawler = $client->request('GET', '/Post/display/category/kategoria-1,1');
        $text=$crawler->filter('div.body-header.mb-5 > h1')
        ->getNode(0)
        ->textContent;

        $this->assertResponseIsSuccessful();
        $this->assertStringContainsString('Kategoria 1', $text);

    }

    public function testDisplayPostCorrect()
    {
        $client=static::createClient();
        $crawler = $client->request('GET', '/Post/display/category/kategoria-1,1');
        
        $userName=$crawler->filter('div.card-user.col-xs-4.col-sm-2 > div.name.mb-1.text-center')
        ->getNode(0)
        ->textContent;

        $createdAt=$crawler->filter('div.card-content.col-xs-12.col-sm-10 > div.date.mt-1')
        ->getNode(0)
        ->textContent;

        $postContent=$crawler->filter('div.card-content-content.my-1')
        ->getNode(0)
        ->textContent;

        $this->assertStringContainsString('admin', $userName);
        $this->assertStringContainsString('12/07/2022 16:46', $createdAt);
        $this->assertStringContainsString('It is a long established fact ', $postContent);

    }

    public function testDisplayCorrectAmoountOfPost()
    {
        $client=static::createClient();
        $crawler = $client->request('GET', '/Post/display/category/kategoria-1,1');
        
        $amountPost=$crawler->filter('div.card.mb-2')
        ->count();

        $this->assertEquals(5,$amountPost);
    }
}