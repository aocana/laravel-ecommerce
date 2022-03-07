<?php

it('GET /shop', function () {
    $response = $this->get('/shop');

    $response->assertStatus(200);
});

it('GET /shop/{slug}', function () {
    $response = $this->get('/shop/{slug}');

    $response->assertStatus(200);
});
