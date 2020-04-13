<?php

namespace Modules\InvoiceDesignExport\Console;

use Illuminate\Console\Command;

class RemoveButtonsCommand extends Command
{
    protected $name = 'invoicedesignexport:remove-buttons';
    protected $description = 'Remove import and export buttons from customize design page';

    public function handle()
    {
        $filePath     = base_path('resources/views/accounts/customize_design.blade.php');
        $fileContent  = file_get_contents($filePath);

        if(false === strstr($fileContent, InsertButtonsCommand::INSERT_NEW_INCLUDE)){
            $this->info('Buttons were already removed!');
            return;
        }

        $one = 1;
        $newFileContent = preg_replace(
            '/'.preg_quote(InsertButtonsCommand::INSERT_NEW_INCLUDE . InsertButtonsCommand::INSERT_BEFORE, '/').'/',
            InsertButtonsCommand::INSERT_BEFORE,
            $fileContent,
            $one
        );

        file_put_contents($filePath, $newFileContent);
        $this->info('Buttons removed!');
    }
}
