<?php

namespace MaxServ\Pool\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class Game extends AbstractEntity
{
    protected int $date;
    protected Player $player1;
    protected Player $player2;
    protected Player $winner;

    public function getDate(): int
    {
        return $this->date;
    }

    public function setDate(int $date): void
    {
        $this->date = $date;
    }

    public function getPlayer1(): Player
    {
        return $this->player1;
    }
    public function setPlayer1(Player $player1): void
    {
        $this->player1 = $player1;
    }

    public function getPlayer2(): Player
    {
        return $this->player2;
    }

    public function setPlayer2(Player $player2): void
    {
        $this->player2 = $player2;
    }

    public function getWinner(): Player
    {
        return $this->winner;
    }

    public function setWinner(Player $winner): void
    {
        $this->winner = $winner;
    }
}