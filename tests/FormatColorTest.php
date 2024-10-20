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

test('It can format a color as RGB value string', function (array $rgb, string $expected) {
    $color = Color::rgb(...$rgb);
    expect($color->toRgbValueString())->toBe($expected);
})
    ->with([
        [[255, 0, 0], '255, 0, 0'],
        [[0, 255, 0], '0, 255, 0'],
        [[0, 0, 255], '0, 0, 255'],
        [[128, 128, 128], '128, 128, 128'],
        [[0, 0, 0], '0, 0, 0'],
        [[255, 255, 255], '255, 255, 255'],
        [[255, 0, 0, 0.5], '255, 0, 0'],
    ]);

test('It can format a color as hex string', function (array $rgb, string $expected, string $expectedWithAlpha) {
    $color = Color::rgb(...$rgb);
    expect($color->toHexString())->toBe($expected);
    expect($color->toHexString(alpha: true))->toBe($expectedWithAlpha);
})
    ->with([
        [[255, 0, 0], '#ff0000', '#ff0000ff'],
        [[0, 255, 0], '#00ff00', '#00ff00ff'],
        [[0, 0, 255], '#0000ff', '#0000ffff'],
        [[128, 128, 128], '#808080', '#808080ff'],
        [[0, 0, 0], '#000000', '#000000ff'],
        [[255, 255, 255], '#ffffff', '#ffffffff'],
        [[255, 0, 0, 0.5], '#ff0000', '#ff00007f'],
    ]);

test('It can format a color as hex string with uppercase', function (array $rgb, string $expected, string $expectedWithAlpha) {
    $color = Color::rgb(...$rgb);
    expect($color->toHexString(uppercase: true))->toBe($expected);
    expect($color->toHexString(alpha: true, uppercase: true))->toBe($expectedWithAlpha);
})
    ->with([
        [[255, 0, 0], '#FF0000', '#FF0000FF'],
        [[0, 255, 0], '#00FF00', '#00FF00FF'],
        [[0, 0, 255], '#0000FF', '#0000FFFF'],
        [[128, 128, 128], '#808080', '#808080FF'],
        [[0, 0, 0], '#000000', '#000000FF'],
        [[255, 255, 255], '#FFFFFF', '#FFFFFFFF'],
        [[255, 0, 0, 0.5], '#FF0000', '#FF00007F'],
    ]);

test('It can format a color as hex string without hash', function (array $rgb, string $expected, string $expectedWithAlpha) {
    $color = Color::rgb(...$rgb);
    expect($color->toHexString(hash: false))->toBe($expected);
    expect($color->toHexString(alpha: true, hash: false))->toBe($expectedWithAlpha);
})
    ->with([
        [[255, 0, 0], 'ff0000', 'ff0000ff'],
        [[0, 255, 0], '00ff00', '00ff00ff'],
        [[0, 0, 255], '0000ff', '0000ffff'],
        [[128, 128, 128], '808080', '808080ff'],
        [[0, 0, 0], '000000', '000000ff'],
        [[255, 255, 255], 'ffffff', 'ffffffff'],
        [[255, 0, 0, 0.5], 'ff0000', 'ff00007f'],
    ]);

test('It can format a color as hex string without hash', function (array $rgb, string $expected, string $expectedWithAlpha) {
    $color = Color::rgb(...$rgb);
    expect($color->toHexString(hash: false))->toBe($expected);
    expect($color->toHexString(alpha: true, hash: false))->toBe($expectedWithAlpha);
})
    ->with([
        [[255, 0, 0], 'ff0000', 'ff0000ff'],
        [[0, 255, 0], '00ff00', '00ff00ff'],
        [[0, 0, 255], '0000ff', '0000ffff'],
        [[128, 128, 128], '808080', '808080ff'],
        [[0, 0, 0], '000000', '000000ff'],
        [[255, 255, 255], 'ffffff', 'ffffffff'],
        [[255, 0, 0, 0.5], 'ff0000', 'ff00007f'],
    ]);

test('It can format a color as HSL string', function (array $rgb, string $expected) {
    $color = Color::rgb(...$rgb);
    expect($color->toHslString())->toBe($expected);
})
    ->with([
        [[255, 0, 0], 'hsl(0, 100%, 50%)'],
        [[0, 255, 0], 'hsl(120, 100%, 50%)'],
        [[0, 0, 255], 'hsl(240, 100%, 50%)'],
        [[128, 128, 128], 'hsl(0, 0%, 50%)'],
        [[0, 0, 0], 'hsl(0, 0%, 0%)'],
        [[255, 255, 255], 'hsl(0, 0%, 100%)'],
        [[255, 128, 0], 'hsl(30, 100%, 50%)'],
    ]);

test('It can format a color as HSLA string', function (array $rgba, string $expected) {
    $color = Color::rgb(...$rgba);
    expect($color->toHslaString())->toBe($expected);
})
    ->with([
        [[255, 0, 0, 1], 'hsla(0, 100%, 50%, 1)'],
        [[0, 255, 0, 0.5], 'hsla(120, 100%, 50%, 0.5)'],
        [[0, 0, 255, 0.25], 'hsla(240, 100%, 50%, 0.25)'],
        [[128, 128, 128, 0.75], 'hsla(0, 0%, 50%, 0.75)'],
        [[0, 0, 0, 0], 'hsla(0, 0%, 0%, 0)'],
        [[255, 255, 255, 1], 'hsla(0, 0%, 100%, 1)'],
        [[255, 128, 0, 0.8], 'hsla(30, 100%, 50%, 0.8)'],
    ]);
