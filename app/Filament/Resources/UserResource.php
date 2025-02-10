<?php

namespace App\Filament\Resources;

use App\Models\User;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\SelectFilter;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Filament\Resources\UserResource\Pages;

class UserResource extends Resource
{
    protected static ?string $model = User::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                // Only show password fields on user creation
                TextInput::make('password')
                    ->password()
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                    ->hiddenOn('edit'),

                TextInput::make('password_confirmation')
                    ->password()
                    ->same('password')
                    ->hiddenOn('edit'),

                // Assign multiple roles using Select
                Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('roles.name')->label('Roles')->sortable()->toggleable()->placeholder('No roles')->badge(),
            ])
            ->filters([
                SelectFilter::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable(),
            ])
            ->actions([
                EditAction::make()->button()->outlined()->slideOver()->modalWidth('xl'),
                DeleteAction::make()->button()->outlined(),

                // New Change Password Action
                Action::make('changePassword')
                    ->label('Change Password')
                    ->icon('heroicon-o-lock-closed')
                    ->modalHeading('Change User Password')
                    ->color('gray')
                    ->button()
                    ->outlined()
                    ->requiresConfirmation()
                    ->form([
                        TextInput::make('new_password')
                            ->label('New Password')
                            ->password()
                            ->required()
                            ->maxLength(255),

                        TextInput::make('new_password_confirmation')
                            ->label('Confirm New Password')
                            ->password()
                            ->required()
                            ->same('new_password'),
                    ])
                    ->action(function (User $record, array $data) {
                        $record->update([
                            'password' => Hash::make($data['new_password']),
                        ]);

                        // Notify the affected user
                        Notification::make()
                            ->title('Password Anda telah diperbarui')
                            ->body('Admin telah mengganti password Anda.')
                            ->success()
                            ->sendToDatabase($record);

                        // Notify the current admin user
                        Notification::make()
                            ->title('Success updating password')
                            ->body('You have successfully updated the user password.')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            // 'create' => Pages\CreateUser::route('/create'),
            // 'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
