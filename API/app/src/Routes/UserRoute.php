<?php
namespace ApostaAiApi\Routes;

use ApostaAiApi\Middleware\NotLoggedInMiddleware;
use ApostaAiApi\Middleware\LoggedInMiddleware;
use ApostaAiApi\Models\User;

use ApostaAiApi\Models\UserQuery;

/**
 * Class UserRoute
 *
 * @package ApostaAiApi\Routes
 */
$this->group("/user", function () {
    $this->post("/register", function ($req, $res) {
        $postData = $req->getParsedBody();
        $user = new User();
        $user->setEmail($postData['email']);
        if ($user->emailExists()) {
            return $res->withJson(["Message" => "Email already exists"], 409);
        }
        $user->setBCryptPassword($postData['password']);
        $user->setName($postData['name']);
        $user->setScore(50);

        if ($user->save()) {
            return $res->withJson(["Message" => "Registered"], 200);
       } else {
            return $res->withJson(["Message" => "Error while registering"], 403);
        }
    })->add(new NotLoggedInMiddleware());

    $this->post("/login", function ($req, $res) {
        $postData = $req->getParsedBody();
        $user = UserQuery::create()->findOneByEmail($postData['email']);
        if (!$user) {
            return $res->withJson(["Message" => 'Email ' . $postData['email'] . ' not found'], 404);
        }
        $password = $postData['password'];
        if ($user->authenticate($password)) {
            $_SESSION['id'] = $user->getId();
            return $res->withJson(["Message" => "Logged in"], 200);
        } else {
            return $res->withStatus(401)->write('Wrong username or password');
        }
    })->add(new NotLoggedInMiddleware());

    $this->get("/logout", function ($req, $res) {
        unset($_SESSION['id']);
        return $res->withJson(["Message" => "Logged out"], 200);
    })->add(new LoggedInMiddleware());

    $this->get("/rank", function ($req, $res) {
        $users = UserQuery::create()
            ->find();

        if (!$users) {
            return $res->withJson(["Message" => "No users"], 404);
        }

        $result['Users'] = $users->toArray();

        foreach ($users as $i => $user) {
            unset($result['Users'][$i]['Password']);
            unset($result['Users'][$i]['Email']);
            $result['Users'][$i]['GoldMedals'] = $user->getMedalCount('gold');
            $result['Users'][$i]['SilverMedals'] = $user->getMedalCount('silver');
            $result['Users'][$i]['BronzeMedals'] = $user->getMedalCount('bronze');
        }

        uasort($result['Users'], function ($a,$b) {
            if ($a['GoldMedals'] === $b['GoldMedals'] && $a['SilverMedals'] === $b['SilverMedals'] &&
                $a['BronzeMedals'] === $b['BronzeMedals']) {
                return 0;
            }

            if ($a['GoldMedals'] > $b['GoldMedals']) {
                return -1;
            } else if ($a['GoldMedals'] < $b['GoldMedals']) {
                return 1;
            } else {
                if ($a['SilverMedals'] > $b['SilverMedals']) {
                    return -1;
                } else if ($a['SilverMedals'] < $b['SilverMedals']) {
                    return 1;
                } else {
                    if ($a['BronzeMedals'] > $b['BronzeMedals']) {
                        return -1;
                    } else if ($a['BronzeMedals'] < $b['BronzeMedals']) {
                        return 1;
                    } else {
                        return 0;
                    }
                }
            }
        });

        // I hate PHP
        $tmp = [];
        foreach ($result['Users'] as $i => $user) {
            $tmp[] = $user;
        }

        return $res->write(json_encode(["Users" => $tmp]));
    });

    $this->get("", function($req, $res) {
        $user = UserQuery::create()->findPk($_SESSION['id']);

        if (!$user) {
            return $res->withJson(["Message" => "User not found"], 404);
        }

        $result = $user->toArray();
        unset($result['Password']);
        $result['GoldMedals'] = $user->getMedalCount('gold');
        $result['SilverMedals'] = $user->getMedalCount('silver');
        $result['BronzeMedals'] = $user->getMedalCount('bronze');

        return $res->write(json_encode($result));
    })->add(new LoggedInMiddleware());
});