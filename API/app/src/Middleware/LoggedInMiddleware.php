<?php
namespace ApostaAiApi\Middleware;
/**
 * Checks if user is logged in
 * @package ApostaAiApi\Middleware
 */
class LoggedInMiddleware {
    /**
     * Checks if user is logged in and passes the response to the next middleware
     *
     */
    public function __invoke($req, $res, $next) {
        if (!isset($_SESSION['id'])) {
            return $res->withJson(["Message" => "Not logged in"], 401);
        }
        return $next($req, $res);
    }
}