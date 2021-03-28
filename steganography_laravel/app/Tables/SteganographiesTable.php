<?php

namespace App\Tables;

use App\Steganography;
use Okipa\LaravelTable\Abstracts\AbstractTable;
use Okipa\LaravelTable\Table;
use Illuminate\Database\Eloquent\Builder;

class SteganographiesTable extends AbstractTable
{
    /**
     * Configure the table itself.
     *
     * @return \Okipa\LaravelTable\Table
     * @throws \ErrorException
     */
    protected function table(): Table
    {
        return (new Table())->model(Steganography::class)
            ->routes([
                'index'   => ['name' => 'steganographies.index'],
                'show'   => ['name' => 'steganographies.show'],
                'create'  => ['name' => 'steganographies.create'],
                'destroy' => ['name' => 'steganographies.destroy'],
            ])
            ;
    }

    /**
     * Configure the table columns.
     *
     * @param \Okipa\LaravelTable\Table $table
     *
     * @throws \ErrorException
     */
    protected function columns(Table $table): void
    {
        $table->column('id')->title(__('ID'))
            //->link(fn(Steganography $steganography) => route('steganographies.show', $steganography))
            //->button(['btn', 'btn-sm', 'btn-primary'])
            ->sortable()
            ->searchable();
        $table->column('steganography_key')->title(__('Key'))->sortable()->searchable();
        $table->column('steganography_message')->title(__('Message'))->sortable()->searchable();
    }

    /**
     * Configure the table result lines.
     *
     * @param \Okipa\LaravelTable\Table $table
     */
    protected function resultLines(Table $table): void
    {
        //
    }
}
