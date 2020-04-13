<?php

namespace Modules\InvoiceDesignExport\Console;

use Illuminate\Console\Command;

class InsertButtonsCommand extends Command
{
    protected $name = 'invoicedesignexport:insert-buttons';
    protected $description = 'Install import and export buttons on customize design page';

    const INSERT_NEW_INCLUDE = "	@include('invoicedesignexport::buttons')\n";
    const INSERT_BEFORE      =  '@stop';

    public function handle()
    {
        $filePath     = base_path('resources/views/accounts/customize_design.blade.php');
        $fileContent  = file_get_contents($filePath);

        if(false !== strstr($fileContent, self::INSERT_NEW_INCLUDE)){
            $this->info('Buttons were already installed!');
            return;
        }

        $one = 1;
        $newFileContent = preg_replace(
            '/'.preg_quote(self::INSERT_BEFORE, '/').'/',
            self::INSERT_NEW_INCLUDE . self::INSERT_BEFORE,
            $fileContent,
            $one
        );

        file_put_contents($filePath, $newFileContent);
        $this->info('Buttons installed!');
    }
}
