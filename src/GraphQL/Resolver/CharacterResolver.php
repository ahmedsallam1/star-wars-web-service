<?php
namespace App\GraphQL\Resolver;

use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use App\Service\CharacterService;

/**
 * Class CharacterResolver
 * @package App\GraphQL\Resolver
 */
class CharacterResolver implements ResolverInterface, AliasedInterface
{

    /**
     * @var CharacterService
     */
    private $characterService;

    /**
     * CharacterResolver constructor.
     * @param CharacterService $characterService
     */
    public function __construct(CharacterService $characterService)
    {
        $this->characterService = $characterService;
    }

    /**
     * @param Argument $args
     * @return null|object
     */
    public function resolve(Argument $args)
    {
        return $this->characterService->getBy($args->getArrayCopy());
    }

    /**
     * @return array
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Character'
        ];
    }
}
