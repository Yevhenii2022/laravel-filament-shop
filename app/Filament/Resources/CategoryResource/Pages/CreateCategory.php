<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Override;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

    // #[Override]
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // #[Override]
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()         
            ->success()
            ->title('Category created')
            ->body('Category created successfully');
    }
}
