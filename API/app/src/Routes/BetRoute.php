<?php
namespace ApostaAiApi\Routes;

use ApostaAiApi\Middleware\LoggedInMiddleware;
use ApostaAiApi\Models\Bet;
use ApostaAiApi\Models\BetQuery;
use ApostaAiApi\Models\ParticipantQuery;
use ApostaAiApi\Models\UserQuery;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Class BetRoute
 *
 * @package ApostaAiApi\Routes
 */

$this->group("/bet", function () {
    $this->get("/participant/{pid}", function($req, $res, $pid) {
        $userBet = BetQuery::create()
            ->filterByChosenParticipantId($pid)
            ->joinWithParticipant()
            ->useParticipantQuery()
                ->joinWithGame()
            ->endUse()
            ->findByUserId($_SESSION['id']);

        if (!$userBet) {
            return $res->withJson(["Message" => "Bet not found"], 404);
        }

        $result["Bet"] = $userBet->toArray()[0];
        unset($result['Bet']['Participant']['Bets']);
        unset($result['Bet']['Participant']['GameId']);
        unset($result['Bet']['Participant']['Game']['Participants']);
        return $res->write(json_encode($result));
    })->add(new LoggedInMiddleware());

    $this->get("", function($req, $res) {
        $userBets = BetQuery::create()
            ->joinWithParticipant()
            ->useParticipantQuery()
              ->joinWithGame()
            ->endUse()
            ->findByUserId($_SESSION["id"]);

        if (!$userBets) {
            return $res->withJson(["Message" => "No bets found"], 404);
        }

        $result['Bets'] = $userBets->toArray();
        foreach ($userBets as $i => $bet) {
            unset($result['Bets'][$i]['Participant']['Bets']);
            unset($result['Bets'][$i]['Participant']['GameId']);
            unset($result['Bets'][$i]['Participant']['Game']['Participants']);
            $result['Bets'][$i]['Participant']['Game']['Participants'] =
                $bet->getParticipant()->getGame()->getParticipants()->toArray();
            unset($result['Bets'][$i]['Participant']['Game']['Participants'][0]['Game']);
            unset($result['Bets'][$i]['Participant']['Game']['Participants'][0]['Bets']);
            unset($result['Bets'][$i]['Participant']['Game']['Participants'][1]['Game']);
            unset($result['Bets'][$i]['Participant']['Game']['Participants'][1]['Bets']);
        }

        return $res->write(json_encode($result));
    })->add(new LoggedInMiddleware());

    $this->post("", function($req, $res) {
        $body = $req->getParsedBody();
        $chosenParticipantId = $body['ChosenParticipantId'];
        $chosenResult = $body['ChosenResult'];
        $participant = ParticipantQuery::create()
            ->findPk($chosenParticipantId);
        if (!$participant) {
            return $res->withJson(["Message" => "Participant couldn't be found"], 404);
        }
        $user = UserQuery::create()->findPk($_SESSION['id']);
        if ($user->getScore() < $participant->getGame()->getBetCost()) {
            return $res->withJson(["Message" => "User doesn't have enough points"], 400);
        }
        $bet = new Bet();
        $bet->setUserId($_SESSION['id']);
        $bet->setChosenParticipantId($chosenParticipantId);
        $bet->setChosenResult($chosenResult);
        try {
            if ($bet->save()) {
                $user->removeScore($participant->getGame()->getBetCost());
                return $res->withJson(["Message" => "Bet was placed"], 200);
            }
        } catch (Exception $e) {}
        return $res->withJson(["Message" => "Bet could not be placed"], 501);
    })->add(new LoggedInMiddleware());

});