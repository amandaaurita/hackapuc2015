<?php

namespace ApostaAiApi\Models;

use ApostaAiApi\Models\Base\Bet as BaseBet;

/**
 * Skeleton subclass for representing a row from the 'bet' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Bet extends BaseBet
{
    const GOLD_MEDAL_VALUE = 10;
    const SILVER_MEDAL_VALUE = 5;
    const BRONZE_MEDAL_VALUE = 1;

    public function submitResult($participantId, $result) {

        // Got the participant right
        if ($this->getChosenParticipantId() === $participantId) {
            // Got the result right
            if ($this->getChosenResult() === $result) {
                $this->setMedal("gold");
                $this->getUser()->addScore(self::GOLD_MEDAL_VALUE);
            } else {
                $this->setMedal("silver");
                $this->getUser()->addScore(self::SILVER_MEDAL_VALUE);
            }
        } else {
            $this->setMedal("bronze");
            $this->getUser()->addScore(self::BRONZE_MEDAL_VALUE);
        }
    }
}
