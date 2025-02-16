<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Models\Project;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    public function getBreadcrumbs(): array
    {
        return [];
    }

    protected function handleRecordCreation(array $data): Model
    {
        $data['slug'] = str($data['name'])->slug();
        $project = Project::create($data);
        return $project;
    }

    protected function getRedirectUrl(): string
    {
        return '/' . $this->record->slug;
    }
}
