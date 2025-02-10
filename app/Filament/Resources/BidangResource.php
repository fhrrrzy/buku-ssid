<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Bidang;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\BulkActionGroup;
use App\Filament\Resources\BidangResource\Pages;

class BidangResource extends Resource
{
    protected static ?string $model = Bidang::class;
    protected static ?int $navigationSort = 2;


    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Bidang Name')
                    ->required()
                    ->maxLength(255)
                    ->suffixIcon('heroicon-o-pencil')
                    ->columnSpanFull(),

                Select::make('opd_id')
                    ->label('OPD')
                    ->native(false)
                    ->relationship('opd', 'name') // Uses model relationship
                    ->required()
                    ->preload()
                    ->suffixIcon('heroicon-o-building-office')
                    ->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->toggleable(),
                TextColumn::make('name')->sortable()->searchable()->toggleable(),
                TextColumn::make('opd.name')
                    ->label('OPD')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('created_at')->dateTime()->toggleable(),
                TextColumn::make('updated_at')->dateTime()->toggleable(),
            ])
            ->actions([
                EditAction::make()
                    ->modalWidth('2xl')
                    ->label('Edit')
                    ->button()
                    ->color('gray')
                    ->icon('heroicon-o-pencil'),
                DeleteAction::make()
                    ->modalWidth('2xl')
                    ->label('Delete')
                    ->button()
                    ->outlined()
                    ->color('danger')
                    ->icon('heroicon-o-trash'),
            ])
            ->bulkActions([
                // Bulk actions for selected records
                BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->icon('heroicon-o-trash')
                ])
                //
            ])
            ->defaultGroup('opd.name') // Group by OPD by default
            ->filters([
                SelectFilter::make('opd_id')
                    ->label('OPD')
                    ->relationship('opd', 'name')
                    ->searchable(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBidangs::route('/'),
            // 'create' => Pages\CreateBidang::route('/create'),
            // 'edit' => Pages\EditBidang::route('/{record}/edit'),
        ];
    }
}
