<?php

namespace ApostaAiApi\Models;

use ApostaAiApi\Models\Base\User as BaseUser;
use Propel\Runtime\Connection\ConnectionInterface;

/**
 * Skeleton subclass for representing a row from the 'user' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class User extends BaseUser
{

    public function setBCryptPassword($v) {
        if ($v === null) {
            return $this;
        }

        $hashedPassword = password_hash($v, PASSWORD_BCRYPT);
        return $this->setPassword($hashedPassword);
    }

    public function authenticate($password) {
        return password_verify($password, $this->getPassword());
    }

    public function emailExists() {
        $user = UserQuery::create()->findOneByEmail($this->getEmail());
        if ($user) {
            return true;
        }
        return false;
    }

    public function addScore($score) {
        $this->setScore($this->getScore() + $score);
    }

    public function removeScore($score) {
        $this->setScore($this->getScore() - $score);
    }
    public function getMedalCount($medal) {
        $virtualColumnName = ucfirst($medal) . "MedalCount";
        if ($this->hasVirtualColumn($virtualColumnName)) {
            return $this->getVirtualColumn($virtualColumnName);
        } else {
            $bets = BetQuery::create()
                ->filterByMedal($medal)
                ->findByUserId($this->id);
            if (!$bets) {
                return 0;
            }
            $this->setVirtualColumn($virtualColumnName, $bets->count());
            return $this->getVirtualColumn($virtualColumnName);
        }
    }
}
