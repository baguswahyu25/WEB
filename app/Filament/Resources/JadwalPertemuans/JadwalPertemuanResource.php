<?php

namespace App\Filament\Resources\JadwalPertemuans;

use App\Filament\Resources\JadwalPertemuans\Pages\CreateJadwalPertemuan;
use App\Filament\Resources\JadwalPertemuans\Pages\EditJadwalPertemuan;
use App\Filament\Resources\JadwalPertemuans\Pages\ListJadwalPertemuans;
use App\Filament\Resources\JadwalPertemuans\Pages\ViewJadwalPertemuan;
use App\Filament\Resources\JadwalPertemuans\Schemas\JadwalPertemuanForm;
use App\Filament\Resources\JadwalPertemuans\Schemas\JadwalPertemuanInfolist;
use App\Filament\Resources\JadwalPertemuans\Tables\JadwalPertemuansTable;
use App\Models\JadwalPertemuan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JadwalPertemuanResource extends Resource
{
    protected static ?string $model = JadwalPertemuan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return JadwalPertemuanForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return JadwalPertemuanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JadwalPertemuansTable::configure($table);
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
            'index' => ListJadwalPertemuans::route('/'),
            'create' => CreateJadwalPertemuan::route('/create'),
            'view' => ViewJadwalPertemuan::route('/{record}'),
            'edit' => EditJadwalPertemuan::route('/{record}/edit'),
        ];
    }
}
