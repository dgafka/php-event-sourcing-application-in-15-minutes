<?php

namespace Ecotone\App;

use Ecotone\Dbal\Configuration\DbalConfiguration;
use Ecotone\EventSourcing\EventSourcingConfiguration;
use Ecotone\Messaging\Attribute\ServiceContext;

class Configuration
{
    #[ServiceContext]
    public function inMemoryEventStorage()
    {
        return [
            // setting up in memory event sourcing
            EventSourcingConfiguration::createInMemory(),
            // turning off default database transactions
            DbalConfiguration::createWithDefaults()
                ->withTransactionOnCommandBus(false)
        ];
    }
}