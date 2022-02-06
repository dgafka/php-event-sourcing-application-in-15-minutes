<?php

namespace Ecotone\App;

class MoneyWasAddedToWallet
{
    public function __construct(public readonly int $walletId, public readonly int $amount) {}
}