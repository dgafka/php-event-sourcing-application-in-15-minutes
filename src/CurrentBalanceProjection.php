<?php

namespace Ecotone\App;

use Ecotone\EventSourcing\Attribute\Projection;
use Ecotone\Modelling\Attribute\EventHandler;
use Ecotone\Modelling\Attribute\QueryHandler;

#[Projection("currentBalance", Wallet::class)]
class CurrentBalanceProjection
{
    private array $walletBalance = [];

    #[EventHandler]
    public function onWalletRegistered(WalletWasRegistered $event): void
    {
        $this->walletBalance[$event->walletId] = 0;
    }

    #[EventHandler]
    public function onMoneyWasAddedToWallet(MoneyWasAddedToWallet $event): void
    {
        $this->walletBalance[$event->walletId] += $event->amount;
    }

    #[EventHandler]
    public function onMoneySubtractedFromWallet(MoneyWasSubtractedFromWallet $event): void
    {
        $this->walletBalance[$event->walletId] -= $event->amount;
    }

    #[QueryHandler("getWalletBalance")]
    public function getWalletBalance(int $walletId): int
    {
        return $this->walletBalance[$walletId];
    }
}