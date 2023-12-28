/**
 * Created by User on 20.03.2018.
 */
CKEDITOR.plugins.add( 'foods', {
    init: function( editor ) {
            editor.addCommand( 'foodsData', {
                exec: function( editor ) {
                    document.foods_editor.run(editor);
                }
            });
        editor.ui.addButton( 'Foods', {
            label: 'Insert Food',
            command: 'foodsData',
            toolbar: 'insert',
            icon: 'https://image.flaticon.com/icons/png/128/148/148712.png'
        });
    }
});
