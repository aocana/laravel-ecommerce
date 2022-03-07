<?php

it('has admin page', function () {
    $response = $this->get('/p4dmin');

    $response->assertStatus(200);
});


it('GET  /p4dmin/products', function () {
    $response = $this->get('/p4dmin/products');

    $response->assertStatus(200);
});

it('GET  /p4dmin/categories', function () {
    $response = $this->get('/p4dmin/categories');

    $response->assertStatus(200);
});
