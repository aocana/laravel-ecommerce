<?php

it('has admin page', function () {
    $response = $this->get('/p4dmin');

    $response->assertStatus(200);
});
