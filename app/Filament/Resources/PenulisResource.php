<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenulisResource\Pages;
use App\Models\Penulis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PenulisResource extends Resource
{
    protected static ?string $model = Penulis::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Berita';
    protected static ?string $navigationLabel = 'Penulis';
    protected static ?string $pluralModelLabel = 'Edit Penulis';

    public static function form(Form $form): Form
    {
        return $form->schema([
            // Nama Penulis
            Forms\Components\TextInput::make('nama_penulis')
                ->required()
                ->maxLength(255),

            // Username
            Forms\Components\TextInput::make('Username')
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true),

            // Password
            Forms\Components\TextInput::make('Password')
                ->password()
                ->required(fn($livewire) => $livewire instanceof Pages\CreatePenulis)
                ->maxLength(255)
                ->dehydrated(fn($state) => filled($state))
                ->dehydrateStateUsing(fn($state) => Hash::make($state)),

            // Avatar Upload
            Forms\Components\FileUpload::make('Avatar')
                ->image()
                ->directory('avatars')
                ->disk('public')
                ->preserveFilenames()
                ->maxSize(1024)
                ->nullable(),


            // Bio
            Forms\Components\Textarea::make('Bio')
                ->rows(3)
                ->maxLength(65535)
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('Avatar')
                    ->label('Avatar')
                    ->disk('public')
                    ->height(40)
                    ->width(40)
                    ->circular()
                    ->getStateUsing(function ($record) {
                        return $record->Avatar ? asset('storage/' . $record->Avatar) : null;
                    })
                    ->defaultImageUrl('/images/no-avatar.png'),
                Tables\Columns\TextColumn::make('id_penulis')->label('No')->sortable(),
                Tables\Columns\TextColumn::make('nama_penulis')->label('Nama Penulis')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('Username')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('Bio')->limit(50)->wrap(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d-M-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime('d-M-Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPenulis::route('/'),
            'create' => Pages\CreatePenulis::route('/create'),
            'edit' => Pages\EditPenulis::route('/{record}/edit'),
        ];
    }
}
