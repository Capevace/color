<?php

use Mateffy\Color;

test('It can adjust the hue of a color', function () {
    $color = Color::hex('#ff0000');
    $hueAdjusted = $color->hue(120);
    expect($hueAdjusted->toHexString())->toBe('#00ff00');
});

test('It can invert a color', function () {
    $color = Color::hex('#ff0000');
    $inverted = $color->invert();
    expect($inverted->toHexString())->toBe('#00ffff');
});

test('It can adjust brightness of a color', function () {
    $color = Color::hex('#808080');
    $lightened = $color->adjustBrightness(0.5);
    $darkened = $color->adjustBrightness(-0.5);
    expect($lightened->toHexString())->toBe('#bfbfbf');
    expect($darkened->toHexString())->toBe('#404040');
});

test('It can lighten a color', function () {
    $color = Color::hex('#800000');
    $lightened = $color->lighten(0.5);
    expect($lightened->toHexString())->toBe('#bf4040');
});

test('It can darken a color', function () {
    $color = Color::hex('#ff8080');
    $darkened = $color->darken(0.5);
    expect($darkened->toHexString())->toBe('#bf4040');
});

test('It can create a complementary color', function () {
    $color = Color::hex('#ff0000');
    $complementary = $color->complementary();
    expect($complementary->toHexString())->toBe('#00ffff');
});
