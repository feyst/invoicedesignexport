<script type="application/javascript">
    $(document).ready(function() {
        let exportButton = "{!! Button::primary(trans('texts.export'))->withAttributes(['onclick' => 'exportDesign()', 'style' => 'margin:2px;'])->appendIcon(Icon::create('download')) !!}";
        let importButton = "{!! Button::primary(trans('texts.import'))->withAttributes(['onclick' => 'importDesign()', 'style' => 'margin:2px;'])->appendIcon(Icon::create('upload')) !!}";
        $(exportButton).insertBefore('[onclick="showHelp()"]');
        $(importButton).insertAfter('[onclick="exportDesign()"]');
    });

    function exportDesign(){
        downloadFile('{{trans('texts.invoice_design')}}.json', getDesignJavascript(), 'application/json');
    }

    function downloadFile(name, content, contentType){
        if(null === document.getElementById('downloadFile')){
            $(document.body).append('<a download="' + name + '" id="downloadFile" style="display:none;"></a>');
        }
        let downloadButton = document.getElementById('downloadFile');
        downloadButton.download = name;
        downloadButton.href=window.URL.createObjectURL(new Blob([content], {type: contentType}))
        downloadButton.click();
    }

    function importDesign(){
        uploadSingleFile('.json', function(json){
            customDesign = JSON.parse(json);
            loadEditor(editorSection);
            clearError();
            refreshPDF(true);
        });
    }

    function uploadSingleFile(extensions, callback){
        $('#uploadSingleFile').remove();
        $(document.body).append('<input type="file" id="uploadSingleFile" style="display:none;" />');
        let uploadInput = $('#uploadSingleFile');
        uploadInput.attr('accept', extensions);
        uploadInput.on('change', function(uploadEvent){
            if(uploadEvent.target.files.length === 1){
                let reader = new FileReader();
                reader.readAsText(uploadEvent.target.files[0], "UTF-8");
                reader.onload = function(uploadLoaded){
                    callback(uploadLoaded.target.result);
                    uploadInput.remove();
                }
            }
        });
        uploadInput.click();
    }
</script>
