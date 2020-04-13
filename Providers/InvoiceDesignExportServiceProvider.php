<?php

namespace Modules\InvoiceDesignExport\Providers;

use App\Providers\AuthServiceProvider;

class InvoiceDesignExportServiceProvider extends AuthServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->commands([
            \Modules\InvoiceDesignExport\Console\InsertButtonsCommand::class,
            \Modules\InvoiceDesignExport\Console\RemoveButtonsCommand::class,
        ]);

        $sourcePath = __DIR__ . '/../Resources/views';
        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/invoicedesignexport';
        }, \Config::get('view.paths')), [$sourcePath]), 'invoicedesignexport');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang/en', 'invoicedesignexport');
    }

}
