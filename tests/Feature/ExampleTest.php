<?php

use Tests\TestCase;

uses(TestCase::class);

it('has welcome page')->get('/')->assertStatus(200);
