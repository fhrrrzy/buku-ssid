<?php

namespace App\Filament\Resources\WifiResource\Pages;

use App\Models\User;
use Filament\Actions;
use App\Filament\Resources\WifiResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Illuminate\Support\Str; // Import Str helper
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;

class ListWifis extends ListRecords
{
    protected static string $resource = WifiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->slideOver()
                ->successNotification(function ($record) {
                    // Get all users
                    $users = User::all();

                    // Send Filament notification to all users
                    Notification::make()
                        ->title('New WiFi Added')
                        ->body(Str::markdown("**A new WiFi record has been created!**  
                            - SSID : `{$record->ssid}`"))
                        ->success()
                        ->sendToDatabase($users)
                        ->send();
                }),

            ExportAction::make()->exports([
                // Pass a string
                ExcelExport::make()
                    ->askForFilename()
                    ->withFilename(fn($filename) => date('Y-m-d') . ' - export ' . $filename)
                    ->queue()->withChunkSize(100)
                    ->askForWriterType(),
            ])
        ];
    }
}
