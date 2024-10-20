<?php

use \Mateffy\Color;


test('It can format a color as RGB string', function (array $rgb, string $expected) {
    $color = Color::rgb(...$rgb);
    expect($color->toRgbString())->toBe($expected);
})
    ->with([
        [[255, 0, 0], 'rgb(255, 0, 0)'],
        [[0, 255, 0], 'rgb(0, 255, 0)'],
        [[0, 0, 255], 'rgb(0, 0, 255)'],
        [[128, 128, 128], 'rgb(128, 128, 128)'],
        [[0, 0, 0], 'rgb(0, 0, 0)'],
        [[255, 255, 255], 'rgb(255, 255, 255)'],
    ]);

test('It can format a color as RGBA string', function (array $rgba, string $expected) {
    $color = Color::rgb(...$rgba);
    expect($color->toRgbaString())->toBe($expected);
})
    ->with([
        [[255, 0, 0, 1], 'rgba(255, 0, 0, 1)'],
        [[0, 255, 0, 0.5], 'rgba(0, 255, 0, 0.5)'],
        [[0, 0, 255, 0.25], 'rgba(0, 0, 255, 0.25)'],
        [[128, 128, 128, 0.75], 'rgba(128, 128, 128, 0.75)'],
        [[0, 0, 0, 0], 'rgba(0, 0, 0, 0)'],
        [[255, 255, 255, 1], 'rgba(255, 255, 255, 1)'],
    ]);
