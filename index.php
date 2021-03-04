<?php

require "vendor/autoload.php";


use App\Command\ApplicationCommand;

$app = new ApplicationCommand();

$app->execute();
