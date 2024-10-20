<?php

use Mateffy\Color;

test('It can calculate luminance', function () {
    $color = Color::rgb(255, 0, 0);
    expect($color->luminance())->toBe(54.213, 0.001);

    $color = Color::rgb(0, 255, 0);
    expect($color->luminance())->toBe(182.376, 0.001);

    $color = Color::rgb(0, 0, 255);
    expect($color->luminance())->toBe(18.411, 0.001);

    $color = Color::rgb(255, 255, 255);
    expect($color->luminance())->toBe(255.0, 0.001);

    $color = Color::rgb(0, 0, 0);
    expect($color->luminance())->toBe(0.0, 0.001);
});

test('It can calculate human luminance', function () {
    $color = Color::rgb(255, 0, 0);
    expect($color->humanLuminance())->toBe(0.299, 0.001);

    $color = Color::rgb(0, 255, 0);
    expect($color->humanLuminance())->toBe(0.587, 0.001);

    $color = Color::rgb(0, 0, 255);
    expect($color->humanLuminance())->toBe(0.114, 0.001);

    $color = Color::rgb(255, 255, 255);
    expect($color->humanLuminance())->toBe(0.0, 0.001);

    $color = Color::rgb(0, 0, 0);
    expect($color->humanLuminance())->toBe(1.0, 0.001);
});

test('It can determine if a color needs light foreground', function () {
    $color = Color::rgb(255, 0, 0);
    expect($color->needsLightForeground())->toBeFalse();

    $color = Color::rgb(0, 0, 0);
    expect($color->needsLightForeground())->toBeTrue();

    $color = Color::rgb(255, 255, 255);
    expect($color->needsLightForeground())->toBeFalse();

    $color = Color::rgb(128, 128, 128);
    expect($color->needsLightForeground())->toBeTrue();
});
