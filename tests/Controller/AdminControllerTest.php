<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

class AdminControllerTest extends WebTestCase
{
    public function testAdminRedirectToPath()
    {
        $client = static::createClient();
        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('admin@admin.com');
        $client->loginUser($testUser);
   
        $crawler=$client->request('GET', '/admin');
        $this->assertResponseIsSuccessful();

        $text= $crawler->filter('article > h2')
        ->getNode(0)
        ->textContent;
        
        $this->assertSame('ADMIN DASHBOARD', $text);

    }

}
