<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
// use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    // protected static ?string $modelLabel = 'Category!!!';

    protected static ?string $navigationGroup = 'Blog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([


                Forms\Components\Wizard::make([

                    Forms\Components\Wizard\Step::make('Основное')->icon('heroicon-o-user')->schema([
                        TextInput::make('first_name')->required(),
                        TextInput::make('middle_name'),
                        TextInput::make('last_name'),
                        TextInput::make('email')->email(),
                        TextInput::make('password')->password()->revealable()->columnSpan('full'),
                    ])->columns(2),

                    Forms\Components\Wizard\Step::make('Контакты')->icon('heroicon-o-map')->schema([
                        Select::make('country')->options(['Country 1', 'Country 2', 'Country 3']),
                        Select::make('city')->options(['City 1', 'City 2', 'City 3']),
                        Select::make('street')->options(['Street 1', 'Street 2', 'Street 3']),
                        TextInput::make('zip')->required(),
                        TextInput::make('phone')->tel()->mask('+99 999 999-99-99'),
                    ])->columns(2),

                    Forms\Components\Wizard\Step::make('Дополнительно')->icon('heroicon-o-user')->schema([
                        Select::make('dob')->options(
                            array_combine(
                                range(date('Y'), 1900),
                                range(date('Y'), 1900),
                            )
                        ),
                        Radio::make('gender')->options(['Male', 'Female']),
                    ])->columns(2),

                    Forms\Components\Wizard\Step::make('Аватар и примечение')->icon('heroicon-o-user')->schema([
                        FileUpload::make('avatar')->image(),
                        Forms\Components\Textarea::make('notes')->rows(5)
                    ])->columns(2),

                ])->columnSpan(2),



        Group::make()->schema([
                        Section::make('Main')->description('Main info about user.')->icon('heroicon-o-user')->schema([
                        TextInput::make('first_name'),
                        TextInput::make('middle_name'),
                        TextInput::make('last_name'),
                        TextInput::make('email')->email(),
                        TextInput::make('password')->password()->revealable()->columnSpan('full'),  
                        ])->columns(2)->collapsible(),

                        Section::make('Address')->description('Address information.')->icon('heroicon-o-home')->schema([
                            Select::make('country')->options(['Country 1', 'Country 2', 'Country 3']),
                            Select::make('city')->options(['City 1', 'City 2', 'City 3']),
                            Select::make('street')->options(['Street 1', 'Street 2', 'Street 3']),
                            TextInput::make('zip'),
                            TextInput::make('phone')->tel()->mask('+99 999 999-99-99'), 
                        ])->columns(2)->collapsible(),
        ])->columnSpan(2),

        Group::make()->schema([
                        Section::make('Additional Info')->description('Additional information.')->icon('heroicon-o-user')->schema([
                        Select::make('dob')->options(
                            array_combine(
                                range(date('Y'), 1900),
                                range(date('Y'), 1900),
                            )
                        ),
                        Radio::make('gender')->options(['Male', 'Female'])->inline()->inlineLabel(false),
                        ])->columns(2)->collapsible(),

                        Section::make('Avatar')->description('Avatar information.')->icon('heroicon-o-user')->schema([
                        FileUpload::make('avatar')->image()->avatar(),
                        ])->collapsible(),

                        Section::make('Notes')->description('Additional notes.')->icon('heroicon-o-document-text')->schema([
                        Textarea::make('notes')->rows(5)
                        ])->collapsible()->collapsed(),
        ]),        
        
        


Forms\Components\Tabs::make()->tabs([

                    Forms\Components\Tabs\Tab::make('Основное')->icon('heroicon-o-user')->schema([
                        TextInput::make('first_name'),
                        TextInput::make('middle_name'),
                        TextInput::make('last_name'),
                        TextInput::make('email')->email(),
                        TextInput::make('password')->password()->revealable()->columnSpan('full'),
                    ])->columns(2),

                    Forms\Components\Tabs\Tab::make('Контакты')->icon('heroicon-o-map')->schema([
                        Select::make('country')->options(['Country 1', 'Country 2', 'Country 3']),
                        Select::make('city')->options(['City 1', 'City 2', 'City 3']),
                        Select::make('street')->options(['Street 1', 'Street 2', 'Street 3']),
                        TextInput::make('zip'),
                        TextInput::make('phone')->tel()->mask('+99 999 999-99-99'),
                    ])->columns(2),

                    Forms\Components\Tabs\Tab::make('Дополнительно')->icon('heroicon-o-user')->schema([
                        Select::make('dob')->options(
                            array_combine(
                                range(date('Y'), 1900),
                                range(date('Y'), 1900),
                            )
                        ),
                        Radio::make('gender')->options(['Male', 'Female']),
                    ])->columns(2),

                    Forms\Components\Tabs\Tab::make('Аватар и примечение')->icon('heroicon-o-user')->schema([
                        FileUpload::make('avatar')->image(),
                        Forms\Components\Textarea::make('notes')->rows(5)
                    ])->columns(2),

                ])->columnSpan(2)




        ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
