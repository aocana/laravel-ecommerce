<?php

it('GET /cart', function () {
    $response = $this->get('/cart');

    $response->assertStatus(200);
});
