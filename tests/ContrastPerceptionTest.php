<?php

use Mateffy\Color;

test('It can calculate luminance', function () {
    $color = Color::rgb(255, 0, 0);
    expect($color->luminance())->toBeCloseTo(54.213, 3);

    $color = Color::rgb(0, 255, 0);
    expect($color->luminance())->toBeCloseTo(182.376, 3);

    $color = Color::rgb(0, 0, 255);
    expect($color->luminance())->toBeCloseTo(18.411, 3);

    $color = Color::rgb(255, 255, 255);
    expect($color->luminance())->toBeCloseTo(255, 3);

    $color = Color::rgb(0, 0, 0);
    expect($color->luminance())->toBeCloseTo(0, 3);
});

test('It can calculate human luminance', function () {
    $color = Color::rgb(255, 0, 0);
    expect($color->humanLuminance())->toBeCloseTo(0.299, 3);

    $color = Color::rgb(0, 255, 0);
    expect($color->humanLuminance())->toBeCloseTo(0.587, 3);

    $color = Color::rgb(0, 0, 255);
    expect($color->humanLuminance())->toBeCloseTo(0.114, 3);

    $color = Color::rgb(255, 255, 255);
    expect($color->humanLuminance())->toBeCloseTo(0, 3);

    $color = Color::rgb(0, 0, 0);
    expect($color->humanLuminance())->toBeCloseTo(1, 3);
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
