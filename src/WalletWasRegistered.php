<?php

namespace Ecotone\App;

class WalletWasRegistered
{
    public function __construct(public readonly int $walletId) {}
}