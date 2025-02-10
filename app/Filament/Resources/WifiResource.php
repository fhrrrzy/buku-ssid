<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Wifi;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use App\Filament\Resources\WifiResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\WifiResource\RelationManagers;
use Filament\Tables\Actions\ViewAction;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Rmsramos\Activitylog\Actions\ActivityLogTimelineTableAction;
use Rmsramos\Activitylog\RelationManagers\ActivitylogRelationManager;

class WifiResource extends Resource
{
    protected static ?string $model = Wifi::class;

    protected static ?string $navigationIcon = 'heroicon-o-wifi';
    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'ssid';

    public static function getGloballySearchableAttributes(): array
    {
        return [
            'brand',
            'type',
            'serial_number',
            'mac_address',
            'ssid',
            'opd.name', // Search for OPD name globally
            'bidang.name' // Search for Bidang name globally
        ];
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('WiFi Details')
                    ->icon('heroicon-o-wifi') // Add icon to section
                    ->description('Details of the WiFi including its brand, serial number, MAC address, and more.')
                    ->schema([
                        TextInput::make('brand')
                            ->required()
                            ->suffixIcon('heroicon-o-cube-transparent'),
                        TextInput::make('type')
                            ->required()
                            ->suffixIcon('heroicon-o-cog'),
                        TextInput::make('serial_number')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->prefix('SN-') // Prefix for Serial Number
                            ->suffixIcon('heroicon-o-qr-code'),
                        TextInput::make('mac_address')
                            ->required()
                            ->mask('**:**:**:**:**:**') // MAC address format
                            ->unique(ignoreRecord: true)
                            ->macAddress()
                            ->suffixIcon('heroicon-o-key'),
                        TextInput::make('ssid')
                            ->required()
                            ->suffixIcon('heroicon-o-wifi'),
                        TextInput::make('password')
                            ->required()
                            ->suffixIcon('heroicon-o-lock-open'),
                        Textarea::make('description')
                            ->columnSpanFull()
                    ])->columns(2),

                Section::make('User Management')
                    ->icon('heroicon-o-user')
                    ->description('Manage router user credentials')
                    ->schema([
                        TextInput::make('user_router')
                            ->label('Router Username')
                            ->required()
                            ->suffixIcon('heroicon-o-user-circle'),
                        TextInput::make('password_router')
                            ->label('Router Password')
                            ->required()
                            ->suffixIcon('heroicon-o-key'),
                    ])->columns(2),

                Section::make('Organization Details')
                    ->icon('heroicon-o-building-office') // Add icon to section
                    ->description('Select the OPD and Bidang this WiFi belongs to.')
                    ->schema([
                        Select::make('opd_id')
                            ->label('OPD')
                            ->native(false)
                            ->relationship('opd', 'name') // Relationship with OPD
                            ->reactive()
                            ->preload()
                            ->required()
                            ->afterStateUpdated(fn(callable $set) => $set('bidang_id', null)) // Clears bidang_id when opd_id changes
                            ->suffixIcon('heroicon-o-building-office'),

                        Select::make('bidang_id')
                            ->label('Bidang')
                            ->native(false)
                            ->options(function (callable $get) {
                                $opdId = $get('opd_id');
                                if ($opdId) {
                                    return \App\Models\Bidang::where('opd_id', $opdId)->pluck('name', 'id');
                                }
                                return [];
                            })
                            ->required()
                            ->reactive() // Ensures dynamic updates
                            ->disabled(fn(callable $get) => !$get('opd_id')) // Disable until OPD is selected
                            ->suffixIcon('heroicon-o-briefcase'),


                    ])->columns(2),

                Section::make('Media')
                    ->icon('heroicon-o-photo') // Add icon to section
                    ->description('Upload photos of the WiFi equipments.')
                    ->schema([
                        FileUpload::make('photos')
                            ->image()
                            ->panelLayout('grid')
                            ->reorderable()
                            ->appendFiles()
                            ->openable()
                            ->downloadable()
                            ->multiple()
                            ->moveFiles()
                            ->maxSize(64000)
                            ->maxParallelUploads(10)
                            ->disk('public')
                            ->directory('wifi-photos')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->toggleable(),
                TextColumn::make('brand')->sortable()->searchable()->toggleable(),
                TextColumn::make('type')->sortable()->searchable()->toggleable(),
                TextColumn::make('serial_number')->sortable()->searchable()->toggleable(),
                TextColumn::make('mac_address')->sortable()->searchable()->toggleable(),
                TextColumn::make('ssid')->sortable()->searchable()->toggleable(),
                TextColumn::make('opd.name')->sortable()->searchable()->toggleable(),
                TextColumn::make('bidang.name')->sortable()->searchable()->toggleable(),
                // ImageColumn::make('photos')->circular()->toggleable(),
                TextColumn::make('created_at')->dateTime()->toggleable(),
                TextColumn::make('updated_at')->dateTime()->toggleable(),
            ])
            ->defaultGroup('opd.name') // Group by OPD name by default
            ->filters([
                SelectFilter::make('opd_id')
                    ->label('OPD')
                    ->relationship('opd', 'name') // Filter by OPD
                    ->preload()
                    ->searchable(),
            ])
            ->actions([
                // Actions for each record
                EditAction::make()
                    ->slideOver()
                    ->label('Edit')
                    ->button()
                    ->color('gray')
                    ->icon('heroicon-o-pencil'),
                ViewAction::make()
                    ->label('View')
                    ->button()
                    ->icon('heroicon-o-eye')
                    ->slideOver()
                    ->outlined()
                    ->color('info'),
                DeleteAction::make()
                    ->modalWidth('2xl')
                    ->label('Delete')
                    ->button()
                    ->outlined()
                    ->color('danger')
                    ->icon('heroicon-o-trash'),
                ActivityLogTimelineTableAction::make('Activities')
                    ->withRelations([
                        'opd',
                        'bidang'
                    ])
                    ->timelineIcons([
                        'created' => 'heroicon-o-check',
                        'updated' => 'heroicon-o-bell-alert',
                    ])
                    ->timelineIconColors([
                        'created' => 'success',
                        'updated' => 'info',
                    ])
                    ->button()
                    ->outlined(),

                //
            ])
            ->bulkActions([
                // Bulk actions for selected records
                BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->icon('heroicon-o-trash'),
                    // ExportBulkAction::make()

                ])
                //
            ])
            ->emptyStateIcon('heroicon-o-wifi') // Icon for the empty state
            ->emptyStateDescription('There are no WiFi records available at the moment. Please add one.') // Description for the empty state
        ;
    }

    public static function getRelations(): array
    {
        return [
            // ActivitylogRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWifis::route('/'),
            // 'create' => Pages\CreateWifi::route('/create'),
            // 'edit' => Pages\EditWifi::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return Wifi::count(); // Shows total WiFi count as a badge
    }
}
