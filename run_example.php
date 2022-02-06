<?php

require __DIR__ . "/vendor/autoload.php";

$application = \Ecotone\Lite\EcotoneLiteApplication::boostrap();

$walletId = 1;
$application->getCommandBus()->sendWithRouting("registerWallet", $walletId);
$application->getCommandBus()->sendWithRouting("addToWallet", 100, metadata: ["aggregate.id" => $walletId]);
$application->getCommandBus()->sendWithRouting("subtractFromWallet", 40, metadata: ["aggregate.id" => $walletId]);

$walletBalance = $application->getQueryBus()->sendWithRouting("getWalletBalance", $walletId);

echo $walletBalance;
