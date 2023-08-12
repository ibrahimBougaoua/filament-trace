<?php

namespace IbrahimBougaoua\FilamentTrace\Resources;

use Filament\Forms;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use IbrahimBougaoua\FilamentTrace\Models\Logger;
use IbrahimBougaoua\FilamentTrace\Resources\TraceLoggerResource\Pages;
use Illuminate\Database\Eloquent\Builder;

class TraceLoggerResource extends Resource
{
    protected static ?string $model = Logger::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Traces';

    protected static ?string $navigationLabel = 'Logger';

    protected static ?string $pluralLabel = 'Logger';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
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
                TextColumn::make('country_code')
                    ->label('Country code')
                    ->icon('heroicon-o-document-text')
                    ->sortable()
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Content copied')
                    ->copyMessageDuration(1500),
                TextColumn::make('country_name')
                    ->label('Country')
                    ->sortable()
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Content copied')
                    ->copyMessageDuration(1500),
                TextColumn::make('state')
                    ->color('secondary')
                    ->copyable()
                    ->copyMessage('Content copied')
                    ->copyMessageDuration(1500),
                TextColumn::make('city')
                    ->label('City')
                    ->sortable()
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Content copied')
                    ->copyMessageDuration(1500),
                TextColumn::make('browser')
                    ->label('Browser')
                    ->sortable()
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Content copied')
                    ->copyMessageDuration(1500),
                TextColumn::make('system')
                    ->label('System')
                    ->sortable()
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Content copied')
                    ->copyMessageDuration(1500),
                TextColumn::make('device')
                    ->label('Device')
                    ->icon('heroicon-o-device-tablet')
                    ->sortable()
                    ->searchable()
                    ->copyable()
                    ->copyMessage('Content copied')
                    ->copyMessageDuration(1500),
                BadgeColumn::make('action')
                    ->label('Action')
                    ->colors([
                        'success' => 'Logged In',
                        'danger' => 'Log Out',
                    ]),
                TextColumn::make('user.name')
                    ->label('User')
                    ->icon('heroicon-o-user')
                    ->copyable()
                    ->copyMessage('Content copied')
                    ->copyMessageDuration(1500),
                TextColumn::make('created_at')
                    ->label('Created at'),
            ])
            ->filters([
                SelectFilter::make('action')
                    ->label('Action')
                    ->options([
                        'Logged In' => 'Logged In',
                        'Log Out' => 'Log Out',
                    ]),
                SelectFilter::make('browser')
                    ->label('Browser')
                    ->options(
                        config('filament-trace.browsers')
                    ),
                SelectFilter::make('device')
                    ->label('Device')
                    ->options([
                        'Unknown Device' => 'Unknown Device',
                        'Mobile' => 'Mobile',
                        'Desktop' => 'Desktop',
                    ]),
                SelectFilter::make('system')
                    ->label('System')
                    ->options(
                        config('filament-trace.systems')
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
                    }),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTraceLoggers::route('/'),
        ];
    }
}
