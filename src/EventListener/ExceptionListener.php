<?php
namespace App\EventListener;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use App\Contract\ApiResponseInterface;

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
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        $request   = $event->getRequest();

        if (in_array('application/json', $request->getAcceptableContentTypes())) {
            $response = $this->createApiResponse($exception);
            $event->setResponse($response);
        }
    }
    
    /**
     * Creates the ApiResponse from any Exception
     *
     * @param \Exception $exception
     *
     * @return ApiResponse
     */
    private function createApiResponse(\Exception $exception)
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
