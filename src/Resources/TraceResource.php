<?php

namespace IbrahimBougaoua\FilamentTrace\Resources;

use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use IbrahimBougaoua\FilamentTrace\Models\Trace;
use IbrahimBougaoua\FilamentTrace\Resources\TraceResource\Pages;
use Illuminate\Database\Eloquent\Builder;

class TraceResource extends Resource
{
    protected static ?string $model = Trace::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Traces';

    protected static ?string $navigationLabel = 'Trace';

    protected static ?string $pluralLabel = 'Trace';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->disabled()
                            ->columnSpan([
                                'md' => 4,
                            ]),
                        TextInput::make('model')
                            ->label('Model')
                            ->disabled()
                            ->columnSpan([
                                'md' => 4,
                            ]),
                        TextInput::make('action')
                            ->label('Action')
                            ->disabled()
                            ->columnSpan([
                                'md' => 4,
                            ]),
                        MarkdownEditor::make('content')
                            ->label('Content')
                            ->disabled()
                            ->columnSpan([
                                'md' => 12,
                            ]),
                    ])
                    ->columns([
                        'md' => 12,
                    ])
                    ->columnSpan('full'),
            ]);
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
                    ->color('secondary')
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
                    ->label('Created at'),
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
                    }),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTraces::route('/'),
        ];
    }
}
