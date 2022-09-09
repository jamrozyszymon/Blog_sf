<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

class OpinionPostControllerTest extends WebTestCase
{
    public function testAddPositiveOpinion(): void
    {
        $client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('user2@user.com');
        $client->loginUser($testUser);

        $client->request('POST', '/Post/8/positive');
        $crawler = $client->request('GET', '/Post/display/category/kategoria-1,1');

        $text= $crawler->filter('.num-positive-8')
        ->getNode(0)
        ->textContent;

        $this->assertStringContainsString(1, $text);

    }

    public function testBackPositiveOpinion(): void
    {
        $client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('user2@user.com');
        $client->loginUser($testUser);

        $client->request('POST', '/Post/12/backpositive');
        $crawler = $client->request('GET', '/Post/display/category/kategoria-1,1');

        $text= $crawler->filter('.num-positive-12')
        ->getNode(0)
        ->textContent;

        $this->assertStringContainsString(0, $text);

    }

    public function testAddNeagtiveOpinion(): void
    {
        $client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('user2@user.com');
        $client->loginUser($testUser);

        $client->request('POST', '/Post/7/negative');
        $crawler = $client->request('GET', '/Post/display/category/kategoria-1,1');

        $text= $crawler->filter('.num-negative-7')
        ->getNode(0)
        ->textContent;

        $this->assertStringContainsString(1, $text);

    }

    public function testBackNeagtiveOpinion(): void
    {
        $client = static::createClient();

        $userRepository = static::getContainer()->get(UserRepository::class);
        $testUser = $userRepository->findOneByEmail('user2@user.com');
        $client->loginUser($testUser);

        $client->request('POST', '/Post/14/backnegative');
        $crawler = $client->request('GET', '/Post/display/category/kategoria-1,1');

        $text= $crawler->filter('.num-negative-14')
        ->getNode(0)
        ->textContent;

        $this->assertStringContainsString(0, $text);

    }
}
