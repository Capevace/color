<?php

use \Mateffy\Color;

test('It can create a color from a hex string', function (string $hex, string $default, string $alpha) {
    $color = Color::hex($hex);

    expect($color->toHexString())->toBe($default);
    expect($color->toHexString(alpha: true))->toBe($alpha);
})
    ->with([
        ['#ff0000', '#ff0000', '#ff0000ff'],
        ['#ff0000ff', '#ff0000', '#ff0000ff'],
        ['#f00', '#ff0000', '#ff0000ff'],
        ['#f0f', '#ff00ff', '#ff00ffff'],
        ['#0f0', '#00ff00', '#00ff00ff'],
        ['#00f0', '#0000ff', '#0000ff00'],
        ['#000', '#000000', '#000000ff'],
        ['#00000000', '#000000', '#00000000'],
        ['#0000', '#000000', '#00000000'],
        ['#ff000080', '#ff0000', '#ff000080'],
        ['#ff0000ee', '#ff0000', '#ff0000ee'],
    ]);

test('It can create a color from an rgb array', function (array $rgb, string $default, string $alpha) {
    $color = Color::rgb(...$rgb);

    expect($color->toHexString())->toBe($default);
    expect($color->toHexString(alpha: true))->toBe($alpha);
})
    ->with([
        [[255, 0, 0], '#ff0000', '#ff0000ff'],
        [[0, 255, 0], '#00ff00', '#00ff00ff'],
        [[0, 0, 255], '#0000ff', '#0000ffff'],
        [[255, 255, 255], '#ffffff', '#ffffffff'],
        [[0, 0, 0], '#000000', '#000000ff'],
        [[128, 128, 128], '#808080', '#808080ff'],
    ]);

test('It can create a color from an rgba array', function (array $rgba, string $default, string $alpha) {
    $color = Color::rgb(...$rgba);

    expect($color->toHexString())->toBe($default);
    expect($color->toHexString(alpha: true))->toBe($alpha);
})
    ->with([
        [[255, 0, 0, 0.5], '#ff0000', '#ff00007f'],
        [[0, 255, 0, 0.5], '#00ff00', '#00ff007f'],
        [[0, 0, 255, 0.5], '#0000ff', '#0000ff7f'],
        [[255, 255, 255, 0.5], '#ffffff', '#ffffff7f'],
        [[0, 0, 0, 0.5], '#000000', '#0000007f'],
        [[128, 128, 128, 0.5], '#808080', '#8080807f'],
    ]);


test('It can create a color from an hsl array', function (array $hsl, string $default, string $alpha) {
    $color = Color::hsl(...$hsl);

    expect($color->toHexString())->toBe($default);
    expect($color->toHexString(alpha: true))->toBe($alpha);
})
    ->with([
        [[0, 0, 1], '#030303', '#030303ff'],
        [[0, 1, 0.5], '#010101', '#010101ff'],
        [[1, 0.5, 0], '#000000', '#000000ff'],
        [[0.5, 0, 0], '#000000', '#000000ff'],
        [[0, 0, 0], '#000000', '#000000ff'],
    ]);
