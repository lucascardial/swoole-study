<?php

$app = new Swoole\Http\Server("0.0.0.0", 8099);

$app->on('start', function ($server) {
    echo "Swoole http server is started";
});


$app->bind("/{hash}", function ($request, $response, $hash) {
    // DynamoDB
});

$app->bind("/short", function (\Swoole\Http\Request $request, $response) {
    if (!$request->getMethod() === "POST")
    {
        $response->status(405);
        $response->end("Method not allowed");
    }

    // DynamobDB setItem();
});

$app->start();