<?php
namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use App\Contract\ApiResponseInterface;

/**
 * Class ExceptionListener
 * @package App\EventListener
 */
class ExceptionListener
{
    /**
     * @var ApiResponseInterface
     */
    private $apiResponse;

    /**
     * @param ApiResponseInterface $apiResponse
     */
    public function __construct(ApiResponseInterface $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $request   = $event->getRequest();

        if (in_array('application/json', $request->getAcceptableContentTypes())) {
            $response = $this->createApiResponse($exception);
            $event->setResponse($response);
        }
    }

    /**
     * Creates the ApiResponse from any Exception
     *
     * @param \Throwable $exception
     * @return mixed
     */
    private function createApiResponse(\Throwable $exception)
    {
        $statusCode = $exception instanceof HttpExceptionInterface
            ? $exception->getStatusCode()
            : $this->apiResponse->getResponse()::HTTP_INTERNAL_SERVER_ERROR
        ;

        $this->apiResponse
            ->setMessage($exception->getMessage())
            ->setStatusCode($statusCode)
        ;

        return $this->apiResponse->toJson();
    }
}
