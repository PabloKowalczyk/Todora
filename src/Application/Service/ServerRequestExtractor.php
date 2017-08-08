<?php

declare(strict_types=1);

namespace Todora\Application\Service;

use Psr\Http\Message\ServerRequestInterface;

class ServerRequestExtractor
{
    /**
     * @return array|\stdClass Depends on $assoc param, like in \json_decode function.
     */
    public function fromJsonBody(ServerRequestInterface $request, bool $assoc = false)
    {
        $requestBody = (string)$request->getBody();

        $requestData = \json_decode($requestBody);

        if (null === $requestData && JSON_ERROR_NONE !== \json_last_error()) {
            throw new \InvalidArgumentException("Passed value is not a valid json string.");
        }

        return $requestData;
    }
}
