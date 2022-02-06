<?php

namespace Ecotone\App;

use Ecotone\Modelling\Attribute\AggregateIdentifier;
use Ecotone\Modelling\Attribute\CommandHandler;
use Ecotone\Modelling\Attribute\EventSourcingAggregate;
use Ecotone\Modelling\Attribute\EventSourcingHandler;
use Ecotone\Modelling\WithAggregateVersioning;

#[EventSourcingAggregate]
class Wallet
{
    use WithAggregateVersioning;

    #[AggregateIdentifier]
    private int $walletId;

    #[CommandHandler("registerWallet")]
    public static function registerWallet(int $walletId): array
    {
        return [new WalletWasRegistered($walletId)];
    }

    #[CommandHandler("addToWallet")]
    public function add(int $amount): array
    {
        return [new MoneyWasAddedToWallet($this->walletId, $amount)];
    }

    #[CommandHandler("subtractFromWallet")]
    public function subtract(int $amount): array
    {
        return [new MoneyWasSubtractedFromWallet($this->walletId, $amount)];
    }

    #[EventSourcingHandler]
    public function onWalletWasRegistered(WalletWasRegistered $event): void
    {
        $this->walletId = $event->walletId;
    }
}