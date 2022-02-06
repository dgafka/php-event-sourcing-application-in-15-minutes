<?php

namespace Ecotone\App;

class MoneyWasSubtractedFromWallet
{
    public function __construct(public readonly int $walletId, public readonly int $amount) {}
}