<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KoleksiResource\Pages;
use App\Models\Koleksi;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KoleksiResource extends Resource
{
    protected static ?string $model = Koleksi::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Koleksi';
    protected static ?string $modelLabel = 'Koleksi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                \Filament\Forms\Components\Section::make('Informasi Koleksi')
                    ->columns(2)
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('judul')
                            ->label('Judul')
                            ->required()
                            ->maxLength(180)
                            ->columnSpanFull(),

                        \Filament\Forms\Components\TextInput::make('pengarang')
                            ->label('Pengarang')
                            ->required()
                            ->maxLength(120),

                        \Filament\Forms\Components\TextInput::make('tahun')
                            ->label('Tahun')
                            ->numeric()
                            ->minValue(1900)
                            ->maxValue((int) now()->addYear()->format('Y'))
                            ->nullable(),

                        \Filament\Forms\Components\Select::make('kategori_id')
                            ->label('Kategori')
                            ->relationship('kategori', 'nama_kategori')
                            ->searchable()
                            ->preload()
                            ->required(),

                        \Filament\Forms\Components\Select::make('jenis')
                            ->label('Jenis')
                            ->options(Koleksi::jenisOptions())
                            ->required(),

                        \Filament\Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),

                \Filament\Forms\Components\Section::make('File & Cover')
                    ->columns(2)
                    ->schema([
                        \Filament\Forms\Components\FileUpload::make('cover')
                            ->label('Cover')
                            ->disk('public')
                            ->directory('covers')
                            ->image()
                            ->imagePreviewHeight('200')
                            ->maxSize(2048)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->nullable(),

                        \Filament\Forms\Components\FileUpload::make('file_pdf')
                            ->label('File PDF')
                            ->disk('public')
                            ->directory('pdf')
                            ->maxSize(20480)
                            ->acceptedFileTypes(['application/pdf'])
                            ->nullable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover')
                    ->label('Cover')
                    ->disk('public')
                    ->square(),
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                Tables\Columns\TextColumn::make('pengarang')
                    ->label('Pengarang')
                    ->searchable()
                    ->sortable()
                    ->limit(24),
                Tables\Columns\TextColumn::make('tahun')
                    ->label('Tahun')
                    ->sortable(),
                Tables\Columns\TextColumn::make('kategori.nama_kategori')
                    ->label('Kategori')
                    ->sortable(),
                Tables\Columns\TextColumn::make('jenis')
                    ->label('Jenis')
                    ->badge()
                    ->color(fn (?string $state) => match ($state) {
                        'buku', 'e-book' => 'success',
                        'jurnal', 'e-jurnal' => 'info',
                        'skripsi' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (?string $state) => Koleksi::jenisOptions()[$state] ?? $state),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis')
                    ->label('Jenis')
                    ->options(Koleksi::jenisOptions()),
                Tables\Filters\SelectFilter::make('kategori_id')
                    ->label('Kategori')
                    ->relationship('kategori', 'nama_kategori'),
            ])
            ->actions([
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKoleksis::route('/'),
            'create' => Pages\CreateKoleksi::route('/create'),
            'edit' => Pages\EditKoleksi::route('/{record}/edit'),
        ];
    }
}
