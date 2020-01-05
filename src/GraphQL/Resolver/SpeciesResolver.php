<?php
namespace App\GraphQL\Resolver;

use Overblog\GraphQLBundle\Definition\Argument;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;
use App\Service\MostSpeciesService;

/**
 * Class CharacterResolver
 * @package App\GraphQL\Resolver
 */
class SpeciesResolver implements ResolverInterface, AliasedInterface
{

    /**
     * @var MostSpeciesService
     */
    private $mostSpeciesService;

    /**
     * CharacterResolver constructor.
     * @param MostSpeciesService $mostSpeciesService
     */
    public function __construct(MostSpeciesService $mostSpeciesService)
    {
        $this->mostSpeciesService = $mostSpeciesService;
    }

    /**
     * @param Argument $args
     * @return null|object
     */
    public function resolve(Argument $args)
    {   
        // var_dump(json_encode($this->mostSpeciesService->getBy($args->getArrayCopy()), true));exit;
        return $this->mostSpeciesService->getBy($args->getArrayCopy());
    }

    /**
     * @return array
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Species'
        ];
    }
}
