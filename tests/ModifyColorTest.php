<?php

use Mateffy\Color;

test('It can lighten a color', function () {
    $color = Color::hex('#ff0000');
    $lightened = $color->lighten(0.2);
    expect($lightened->toHexString())->toBe('#ff3333');
});

test('It can darken a color', function () {
    $color = Color::hex('#ff0000');
    $darkened = $color->darken(0.2);
    expect($darkened->toHexString())->toBe('#cc0000');
});

test('It can saturate a color', function () {
    $color = Color::hex('#808080');
    $saturated = $color->saturate(0.5);
    expect($saturated->toHexString())->toBe('#bf4040');
});

test('It can desaturate a color', function () {
    $color = Color::hex('#ff0000');
    $desaturated = $color->desaturate(0.5);
    expect($desaturated->toHexString())->toBe('#bf4040');
});

test('It can adjust the hue of a color', function () {
    $color = Color::hex('#ff0000');
    $hueAdjusted = $color->hue(120);
    expect($hueAdjusted->toHexString())->toBe('#00ff00');
});

test('It can rotate the hue of a color', function () {
    $color = Color::hex('#ff0000');
    $hueRotated = $color->rotate(120);
    expect($hueRotated->toHexString())->toBe('#00ff00');
});

test('It can adjust the alpha of a color', function () {
    $color = Color::hex('#ff0000');
    $alphaAdjusted = $color->alpha(0.5);
    expect($alphaAdjusted->toHexString(alpha: true))->toBe('#ff00007f');
});

test('It can invert a color', function () {
    $color = Color::hex('#ff0000');
    $inverted = $color->invert();
    expect($inverted->toHexString())->toBe('#00ffff');
});

test('It can mix two colors', function () {
    $color1 = Color::hex('#ff0000');
    $color2 = Color::hex('#0000ff');
    $mixed = $color1->mix($color2, 0.5);
    expect($mixed->toHexString())->toBe('#800080');
});

test('It can get the complement of a color', function () {
    $color = Color::hex('#ff0000');
    $complement = $color->complement();
    expect($complement->toHexString())->toBe('#00ffff');
});

test('It can get the grayscale of a color', function () {
    $color = Color::hex('#ff0000');
    $grayscale = $color->grayscale();
    expect($grayscale->toHexString())->toBe('#4d4d4d');
});
