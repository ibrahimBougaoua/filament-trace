<?php

namespace IbrahimBougaoua\FilamentTrace\Resources;

use App\Models\User;
use Filament\Tables\Actions\Modal\Actions\Action;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use IbrahimBougaoua\FilamentTrace\FilamentTrace;
use IbrahimBougaoua\FilamentTrace\Models\Trace;
use IbrahimBougaoua\FilamentTrace\Resources\TraceResource\Pages;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TraceResource extends Resource
{
    protected static ?string $model = Trace::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    public static function canCreate(): bool
    {
        return false;
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('Name')
                ->icon('heroicon-o-document-text')
                ->sortable()
                ->searchable(),
                TextColumn::make('model')
                ->label('Model')
                ->sortable()
                ->searchable(),
                TextColumn::make('content')
                ->icon('heroicon-o-clipboard')
                ->limit(50)
                ->copyable()
                ->copyMessage('Content copied')
                ->copyMessageDuration(1500),
                BadgeColumn::make('action')
                ->label('Action')
                ->colors([
                    'primary' => 'Restored',
                    'secondary' => 'Updated',
                    'success' => 'Created',
                    'danger' => 'Deleted',
                ]),
                TextColumn::make('user.name')
                ->label('User')
                ->icon('heroicon-o-user'),
                TextColumn::make('created_at')
                ->label('Created at')
            ])
            ->filters([
                SelectFilter::make('action')
                ->label('Action')
                ->options([
                    'Restored' => 'Restored',
                    'Updated' => 'Updated',
                    'Created' => 'Created',
                    'Deleted' => 'Deleted',
                ]),
                SelectFilter::make('user_id')
                ->multiple()
                ->options(
                    User::all()->pluck('id','name')
                ),
                Tables\Filters\Filter::make('created_at')
                ->label('Created at')->form([
                    Forms\Components\DatePicker::make('created_from')->label('Created from'),
                    Forms\Components\DatePicker::make('created_until')->label('Created until'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['created_from'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                        )
                        ->when(
                            $data['created_until'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                        );
                })
            ])
            ->actions([
                
            ])
            ->bulkActions([
                
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTraces::route('/'),
        ];
    }    
}