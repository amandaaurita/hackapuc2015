<?php
namespace ApostaAiApi\Middleware;

class AuthorizeByIdMiddleware {

    public function __invoke($req, $res, $next) {
        $route = $req->getAttribute('route');
        $userId = $route->getArgument('id');
        if ($userId != $_SESSION['id']) {
            return $res->withJson(["Message" => "Unauthorized"], 401);
        }
        return $next($req, $res);
    }
}