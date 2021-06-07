<?php

use Tests\TestCase;

it('has welcome page')->get('/')->assertStatus(200);
