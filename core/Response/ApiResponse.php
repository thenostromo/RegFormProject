<?php
namespace Core\Response;

use Core\Provider\GeneralProvider;

class ApiResponse
{
    /**
     * @var int
     */
    public $status;

    /**
     * @var string|null
     */
    public $message;

    /**
     * @var array
     */
    public $payload;

    public function __construct(
        $status = GeneralProvider::API_RESPONSE_STATUS_SUCCESS,
        $message = null,
        $payload = []
    ) {
        $this->status = $status;
        $this->message = $message;
        $this->payload = $payload;
    }
}