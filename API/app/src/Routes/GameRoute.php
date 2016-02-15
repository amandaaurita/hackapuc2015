<?php
namespace ApostaAiApi\Routes;

use ApostaAiApi\Middleware\LoggedInMiddleware;
use ApostaAiApi\Models\BetQuery;
use ApostaAiApi\Models\GameQuery;
use ApostaAiApi\Models\ParticipantQuery;
use Propel\Runtime\Propel;

/**
 * Class GameRoute
 *
 * @package ApostaAiApi\Routes
 */

$this->group("/game", function () {
    $this->post('/{id}/result', function ($req, $res, $id) {
        $postData = $req->getParsedBody();

        $game = GameQuery::create()->findPk($id);
        if (!$game) {
            return $res->withJson(["Message" => "Game not found"], 404);
        }

        if ($game->getResult()) {
            return $res->withJson(["Message" => "Game already has a result"], 409);
        }

        $game->setResult($postData['Result']);
        $game->setFinish(time());

        $winner = ParticipantQuery::create()
            ->filterByName($postData['Winner'])
            ->findOneByGameId($game->getId());

        if (!$winner) {
            return $res->withJson(['Message' => 'Participant ' . $postData['winner'] . ' not found'], 404);
        }
        $winner->setIsWinner(true);

        $bets = BetQuery::create()
            ->joinWithParticipant()
            ->useParticipantQuery()
                ->filterByGameId($game->getId())
            ->endUse()
            ->find();

        foreach ($bets as $bet) {
            $bet->submitResult($winner->getId(), $game->getResult());
        }
        $game->save();
        $winner->save();
        $bets->save();
        return $res->withJson(['Message' => 'Game ' . $game->getId() . ' updated'], 200);
    });

    $this->get('/{id}', function ($req, $res, $id) {
        $game = GameQuery::create()->findPk($id);

        if ($game) {
            return $res->write($game->toJSON());
        } else {
            return $res->withJson(["Message" => "Game not found"], 404);
        }
    });

    $this->get('', function ($req, $res) {
        $games = GameQuery::create()
            ->joinWithParticipant()
            ->find();
        if (!$games) {
            return $res->withJson(["Message" => "Server Error"], 501);
        }

        $bets = BetQuery::create()
            ->joinWithParticipant()
            ->useParticipantQuery()
                ->joinWithGame()
            ->endUse()
            ->findByUserId($_SESSION['id']);

        $ignoredGameIds = [];
        foreach ($bets->toArray() as $bet) {
            array_push($ignoredGameIds, $bet['Participant']['GameId']);
        }

        $result['Games'] = [];
        foreach ($games->toArray() as $i => $game) {
            if (in_array($game['Id'], $ignoredGameIds)) {
                continue;
            }
            foreach ($game['Participants'] as $j => $participant) {
                unset($game['Participants'][$j]['Game']);
                unset($game['Participants'][$j]['GameId']);
            }
            array_push($result['Games'], $game);
        }
        return $res->write(json_encode($result));
    })->add(new LoggedInMiddleware());
});
