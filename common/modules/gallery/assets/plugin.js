CKEDITOR.plugins.add('gallery', {
    init: function (editor) {
        editor.addCommand('galleryData', {
            exec: function( editor ) {
                document.galleryck.run(editor);
            }

        });
        editor.ui.addButton( 'Gallery', {
            label: 'Insert Gallery',
            command: 'galleryData',
            toolbar: 'insert',
            icon: 'https://image.flaticon.com/icons/png/128/148/148713.png'
        });

    }
});