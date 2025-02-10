<?php namespace AltDesign\AltAdminBar\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View;

class InjectAdminBar
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only modify successful HTML responses
//        if ($response->isSuccessful() && false
//            && str_contains($response->headers->get('Content-Type'), 'text/html')) {
//
//
//            $content = $response->getContent();
//            $injectedHtml = View::make('alt-admin-bar::bar')->render();
//
//            // Inject before </body>
//            $content = str_replace('</body>', $injectedHtml . '</body>', $content);
//
//            $response->setContent($content);
//        }
        return $response;
    }

    private function getEntryFromRoute()
    {
        // Get current route
        $route = Route::current();

        // Get bound model (if any)
        return $route?->parameter('entry') ?? $route?->parameters();
    }
}
