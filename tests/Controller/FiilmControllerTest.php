<?php
namespace App\Controller\FilmControllerTest;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class FilmControllerTest
 * @package App\Controller\FilmControllerTest
 */
class FilmControllerTest extends WebTestCase
{
    /**
     * @var
     */
    private $client;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * @test
     */
    public function testIndex()
    {
        $this->client->request('GET', '/api/films', [
            'query' => ['longest' => 'title']
        ]);
        $response = $this->client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('application/json', $response->headers->get('Content-Type'));
        $this->assertJson($response->getContent());
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}
