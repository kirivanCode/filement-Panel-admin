<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductoResource\Pages;
use App\Filament\Resources\ProductoResource\RelationManagers;
use App\Models\Producto;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;  // Importa la clase TextColumn
use Filament\Forms\Components\TextInput; // Importa la clase TextInput
use Filament\Forms\Components\Textarea;  // Importa la clase Textarea
use Filament\Tables\Columns\DateColumn;  // Importa la clase DateColumn (si la usas)
use Filament\Tables\Actions\EditAction;  // Importa la clase EditAction
use Filament\Tables\Actions\DeleteBulkAction;  // Importa la clase DeleteBulkAction

class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('nombre')
                ->required()
                ->label('Nombre del Producto'),
            Textarea::make('descripcion')
                ->label('Descripción'),
            TextInput::make('precio')
                ->numeric()
                ->required()
                ->label('Precio'),
            TextInput::make('stock')
                ->numeric()
                ->required()
                ->label('Stock Disponible'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('nombre')
                ->sortable()
                ->searchable()
                ->label('Nombre'),
            TextColumn::make('precio')
                ->sortable()
                ->label('Precio'),
            TextColumn::make('stock')
                ->sortable()
                ->label('Stock'),
            TextColumn::make('created_at')
                ->dateTime()
                ->label('Creado'),
        ])
        ->filters([
            //
        ])
        ->actions([
            EditAction::make(),
        ])
        ->bulkActions([
            DeleteBulkAction::make(),
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
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProducto::route('/create'),
            'edit' => Pages\EditProducto::route('/{record}/edit'),
        ];
    }    
}
