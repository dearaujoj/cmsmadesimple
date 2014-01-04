// minify when this is working, need this file as we use tinymce.min.js and plugins load based on tinymce core file either min or regular
tinymce.PluginManager.add('cmsms_filebrowser', function(editor) {

    function cmsmsFileBrowser() {
        
        editor.focus(true);
        
        win = editor.windowManager.open({
            title : cmsms_tiny.filepicker_title,
            file : cmsms_tiny.filepicker_url,
            classes : 'filepicker',
            width : 900,
            height : 600,
            inline : 1,
            resizable : true,
            maximizable : true
        });
    }

    editor.addButton('cmsms_filebrowser', {
        icon : 'browse',
        tooltip : cmsms_tiny.filebrowser_title,
        onclick : cmsmsFileBrowser
    });

    editor.addMenuItem('cmsms_filebrowser', {
        icon : 'browse',
        text : cmsms_tiny.filebrowser_title,
        onclick : cmsmsFileBrowser,
        context : 'insert',
        prependToContext: true
    });
});
