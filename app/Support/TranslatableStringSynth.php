<?php

namespace App\Support;

use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;

class TranslatableStringSynth extends Synth
{
    public static $key = 'tstr';

    public static function match($target)
    {
        return $target instanceof TranslatableString;
    }

    public function dehydrate($target)
    {
        return [
            $target instanceof TranslatableString ? $target->toArray() : (array) $target,
            [],
        ];
    }

    public function hydrate($value)
    {
        return new TranslatableString($value);
    }

    public function get(&$target, $key)
    {
        return $target[$key] ?? null;
    }

    public function set(&$target, $key, $value)
    {
        $target[$key] = $value;
    }
}
