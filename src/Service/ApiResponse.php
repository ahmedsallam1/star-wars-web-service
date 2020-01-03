<?php
namespace App\Service;

use App\Contract\ApiResponseInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Factory\HttpResponseFactory;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiResponse
 * @package App\Service
 */
final class ApiResponse implements ApiResponseInterface
{
    /**
     * @var Response
     */
    private $response;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var mixed
     */
    private $data;

    /**
     * @var string|null
     */
    private $message;

    /**
     * @var mixed
     */
    private $error;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @param HttpResponseFactory $response
     * @param SerializerInterface $serializer
     */
    public function __construct(HttpResponseFactory $response, SerializerInterface $serializer)
    {
        $this->setResponse($response::create());
        $this->serializer = $serializer;
        $this->setStatusCode($this->getResponse()::HTTP_OK);
    }

    /**
     * @return string
     */
    public function toJson()
    {
        $content = [
            'data' => $this->getData(),
            'message' => $this->getMessage(),
            'error' => $this->getError(),
        ];

        return $this->getResponse()->create(
            $this->serializer->serialize($content, 'json'),
            $this->getStatusCode()
        );
    }

    /**
     * @param $data
     *
     * @return ApiResponse
     */
    public function setData($data = null) : self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string|null $message
     *
     * @return ApiResponse
     */
    public function setMessage($message = null) : self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param $error
     *
     * @return ApiResponse
     */
    public function setError($error) : self
    {
        $this->error = $error;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param int $statusCode
     *
     * @return ApiResponse
     */
    public function setStatusCode(int $statusCode) : self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $response
     *
     * @return ApiResponse
     */
    public function setResponse($response) : self
    {
        $this->response = $response;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }
}
