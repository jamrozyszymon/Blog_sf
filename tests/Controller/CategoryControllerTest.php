<?php

namespace App\Tests\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();

        //cache clear
        self::bootKernel();
        $container = static::getContainer();
        $cache = $container->get('App\Cache\CacheInterface');
        $this-> cache = $cache->cache;
        $this->cache->clear();
    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->cache->clear();
    }

    public function testCategoryListInNavDisplay()
    {
        $crawler = $this->client->request('GET', '/Category/display');

        $text = $crawler->filter('body > main > div > div > nav > div > a:nth-child(1)')
        ->getNode(0)
        ->textContent;

        $amountCategory=$crawler->filter('body > main > div > div > nav > div > a')
        ->count();

        $this->assertStringContainsString('Kategoria 1', $text);
        $this->assertEquals(2,$amountCategory);
    }

    public function testCategoryListDisplay()
    {
        $crawler = $this->client->request('GET', '/Category/display');

        $text=$crawler->filter('body > main > div > div > article > h1')
        ->getNode(0)
        ->textContent;
        $this->assertResponseIsSuccessful();
        $this->assertStringContainsString('Aktywne kategorie', $text);
    }

    public function testCorrectDisplayUniqueCategory()
    {
        $crawler = $this->client->request('GET', '/Category/display');
        
        $categoryName=$crawler->filter('div.card-title.col-8.h3.ml-2 > a')
        ->getNode(0)
        ->textContent;

        $categoryDescription=$crawler->filter('div.cart-content.col-8.mb-2')
        ->getNode(0)
        ->textContent;

        $numPostInCategory=$crawler->filter('div.cart-num-post.col-4.mt-2 > b')
        ->getNode(0)
        ->textContent;

        $authorName=$crawler->filter('div.cart-info.col-4')
        ->getNode(0)
        ->textContent;

        $this->assertStringContainsString('Kategoria 1', $categoryName);
        $this->assertStringContainsString('Lorem Ipsum', $categoryDescription);
        $this->assertStringContainsString('5', $numPostInCategory);
        $this->assertStringContainsString('user4', $authorName);
    }


}
