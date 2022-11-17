<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Support;

final class HttpRequestOptions
{
    /**
     * timeout: (float, default=0) Float describing the timeout of the
     * request in seconds. Use 0 to wait indefinitely (the default behavior).
     */
    public const TIMEOUT = 'timeout';

    /**
     * connect_timeout: (float, default=0) Float describing the number of
     * seconds to wait while trying to connect to a server. Use 0 to wait
     * indefinitely (the default behavior).
     */
    public const CONNECT_TIMEOUT = 'connect_timeout';

    /**
     * headers: (array) Associative array of HTTP headers. Each value MUST be
     * a string or array of strings.
     */
    public const HEADERS = 'headers';

    /**
     * body: (resource|string|null|int|float|StreamInterface|callable|\Iterator)
     * Body to send in the request.
     */
    public const BODY = 'body';

    /**
     * form_params: (array) Associative array of form field names to values
     * where each value is a string or array of strings. Sets the Content-Type
     * header to application/x-www-form-urlencoded when no Content-Type header
     * is already present.
     */
    public const FORM_PARAMS = 'form_params';
}
