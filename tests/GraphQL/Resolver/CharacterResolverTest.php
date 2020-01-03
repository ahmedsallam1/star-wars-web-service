<?php
namespace App\GraphQL\Resolver;

use App\Document\People;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Overblog\GraphQLBundle\Definition\Argument;

class CharacterResolverTest extends KernelTestCase
{
    /**
     * @var CharacterResolver
     */
    private $characterResolver;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();

        $this->characterResolver = $kernel->getContainer()
            ->get(CharacterResolver::class)
        ;
    }

    /**
     * @test
     */
    public function testGetAliases()
    {
        $this->assertTrue(is_array($this->characterResolver::getAliases()));
    }

    /**
     * @test
     */
    public function testResolve()
    {
        $args = $this
            ->getMockBuilder(Argument::class)
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $args
            ->expects($this->any())
            ->method('getArrayCopy')
            ->will($this->returnValue(['isMostAppeared' => true]))
        ;
        $character = $this->characterResolver->resolve($args);

        $this->assertInstanceOf(People::class, $character);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
}
