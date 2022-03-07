<?php

it('has shop page', function () {
    $response = $this->get('/shop');

    $response->assertStatus(200);
});
