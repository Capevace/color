<?php

use Mateffy\Color;

test('It can adjust the hue of a color', function () {
    $color = Color::hex('#ff0000');
    $hueAdjusted = $color->hue(120);
    expect($hueAdjusted->toHexString())->toBe('#00ff00');
});
