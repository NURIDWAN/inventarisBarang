<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Inventory;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Wizard\Step;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\InventoryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\InventoryResource\RelationManagers;
use App\Filament\Resources\InventoryResource\Pages\EditInventory;
use App\Filament\Resources\InventoryResource\Pages\CreateInventory;
use App\Filament\Resources\InventoryResource\Pages\ListInventories;

class InventoryResource extends Resource
{
    protected static ?string $model = Inventory::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'iventory';

    public static function getGloballySearchableAttributes(): array
    {
    return ['warehouse.name', 'store.name', 'product.name', 'unit.name', 'quantity'];
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                ->schema([
                    Wizard::make([
                        Wizard\Step::make('Warehouse And Store')
                            ->schema([
                                Select::make('warehouse_id')
                                        ->relationship('warehouse', 'name')
                                        ->preload()
                                        ->required(),
                                Select::make('store_id')
                                        ->relationship('store', 'name')
                                        ->preload()
                                        ->required(),
                            ]),
                        Wizard\Step::make('Product')
                            ->schema([
                                Select::make('product_id')
                                        ->relationship('product', 'name')
                                        ->preload()
                                        ->required(),
                                Select::make('unit_id')
                                        ->relationship('unit', 'name')
                                        ->preload()
                                        ->required(),
                                TextInput::make('quantity')
                                        ->required()
                                        ->maxLength(255),
                            ]),
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),
                TextColumn::make('warehouse.name')
                    ->searchable(),
                TextColumn::make('store.name')
                    ->searchable(),
                TextColumn::make('product.name')
                    ->searchable(),
                BadgeColumn::make('quantity')
                    ->color(static function ($state): string {
                        if ($state >= 10) {
                            return 'success';
                        }
                        if ($state >= 5) {
                            return 'warning';
                        }

                        return 'danger';
                    }),
                TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListInventories::route('/'),
            'create' => Pages\CreateInventory::route('/create'),
            'edit' => Pages\EditInventory::route('/{record}/edit'),
        ];
    }
}
