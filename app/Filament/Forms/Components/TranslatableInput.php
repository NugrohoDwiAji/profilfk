<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Tabs;

class TranslatableInput
{
    /**
     * Create a 3-language text input group.
     */
    public static function text(string $name, string $label, bool $required = false): Fieldset
    {
        return Fieldset::make($label)
            ->schema([
                TextInput::make("{$name}.id")
                    ->label('🇮🇩 Bahasa Indonesia')
                    ->placeholder("Isi {$label} dalam Bahasa Indonesia")
                    ->required($required),
                TextInput::make("{$name}.en")
                    ->label('🇬🇧 English')
                    ->placeholder("Enter {$label} in English"),
                TextInput::make("{$name}.zh")
                    ->label('🇨🇳 中文 (Mandarin)')
                    ->placeholder("输入中文 {$label}"),
            ])
            ->columns(3);
    }

    /**
     * Create a 3-language textarea group.
     */
    public static function textarea(string $name, string $label, bool $required = false, int $rows = 3): Fieldset
    {
        return Fieldset::make($label)
            ->schema([
                Textarea::make("{$name}.id")
                    ->label('🇮🇩 Bahasa Indonesia')
                    ->placeholder("Tuliskan {$label} dalam Bahasa Indonesia")
                    ->rows($rows)
                    ->required($required),
                Textarea::make("{$name}.en")
                    ->label('🇬🇧 English')
                    ->placeholder("Write {$label} in English")
                    ->rows($rows),
                Textarea::make("{$name}.zh")
                    ->label('🇨🇳 中文 (Mandarin)')
                    ->placeholder("输入中文 {$label}")
                    ->rows($rows),
            ])
            ->columns(3);
    }

    /**
     * Create a 3-language rich editor tabs group.
     */
    public static function richEditor(string $name, string $label, bool $required = false): Tabs
    {
        return Tabs::make($label)
            ->tabs([
                Tabs\Tab::make('🇮🇩 Bahasa Indonesia')
                    ->schema([
                        RichEditor::make("{$name}.id")
                            ->label("{$label} (Bahasa Indonesia)")
                            ->required($required),
                    ]),
                Tabs\Tab::make('🇬🇧 English')
                    ->schema([
                        RichEditor::make("{$name}.en")
                            ->label("{$label} (English)"),
                    ]),
                Tabs\Tab::make('🇨🇳 中文 (Mandarin)')
                    ->schema([
                        RichEditor::make("{$name}.zh")
                            ->label("{$label} (中文)"),
                    ]),
            ]);
    }
}
