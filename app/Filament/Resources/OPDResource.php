<?php

namespace App\Filament\Resources;

use App\Models\OPD;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use App\Filament\Resources\OPDResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\OPDResource\RelationManagers;
use App\Filament\Resources\OPDResource\RelationManagers\BidangRelationManager;

class OPDResource extends Resource
{
    protected static ?string $model = OPD::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $label = 'OPD';
    protected static ?string $pluralLabel = 'OPD';
    protected static ?string $slug = 'OPD';
    protected static ?int $navigationSort = 1;
    // protected static ?string $table = 'opds';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->suffixIcon('heroicon-o-building-office')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('created_at')->dateTime()->sortable(),
                TextColumn::make('updated_at')->dateTime()->sortable(),
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
            ->filters([
                //
            ])
            ->emptyStateIcon('heroicon-o-building-office') // Icon for the empty state
            ->emptyStateDescription('There are no OPDs available at the moment. Please add one.') // Description for the empty state
        ;
    }

    public static function getRelations(): array
    {
        return [
            BidangRelationManager::class, // Add the Bidang RelationManager
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOPDs::route('/'),
            // 'create' => Pages\CreateOPD::route('/create'),
            // 'edit' => Pages\EditOPD::route('/{record}/edit'),
        ];
    }
}
