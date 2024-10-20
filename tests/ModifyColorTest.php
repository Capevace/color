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

test('It can create a complementary color', function () {
    $color = Color::hex('#ff0000');
    $complementary = $color->complementary();
    expect($complementary->toHexString())->toBe('#00ffff');
});
