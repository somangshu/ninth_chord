<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Cookie;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Session\TokenMismatchException;
use \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken  as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    public function handle($request, Closure $next)
	{
	    if ($this->isReading($request) || $this->excludedRoutes($request) || $this->tokensMatch($request))
	    {
	        return $this->addCookieToResponse($request, $next($request));
	    }

	    throw new TokenMismatchException;
	}

	protected function excludedRoutes($request)
	{
	    $routes = [
	            'api/v1/appcamera/store',
	            'api/v1/instagram/instagramproductimage',
	            'api/v1/instagram/instagramobjectcollection',
	            'api/v1/instagram/instagramfeaturedobject',
	            'api/v1/feed/likes',
	            'api/v1/feed/comments',
	            'api/v1/feed/reportfeed',
	            'api/v1/feed/savedfeedforlater',
	            'api/v1/feed/feedcontent',
	            'api/v1/store/',
	    ];

	    foreach($routes as $route)
	        if ($request->is($route))
	            return true;

	        return false;
	}
}
