(function () {
  //console.log( my_plugin.themes );
  options = JSON.parse( my_plugin.popups );
    tinymce.PluginManager.add('wdm_mce_button', function(editor, url) {
        editor.addButton('wdm_mce_button', {
            icon: false,
            text: 'Catch Popup',
            onclick: function (e) {
                editor.windowManager.open( {
                    title: 'Catch Popup',
                    body: [
                      {
                          type: 'listbox',
                          values: options,
                          name: 'title',
                          label: 'Targeted Popup',
                      },
                      {
                          type: 'textbox',
                          placeholder: 'eg: p, span, div',
                          name: 'tag',
                          label: 'HTML Tag',
                      },
                      {
                          type: 'textbox',
                          placeholder: '',
                          name: 'class',
                          label: 'Class',
                      },
                      {
                          type: 'textbox',
                          placeholder: '',
                          name: 'content',
                          label: 'Content',
                          multiline: true,
                      }
                    ],
                    onsubmit: function( e ) {
                      console.log(e);
                        // wrap it with a div and give it a class name
                        editor.insertContent( '[catch-popup id="' + e.data.title + '" html_tag="' + e.data.tag + '" popup_class="' + e.data.class + '"]' + e.data.content + '[/catch-popup]');
                    }
                });
            }
        });
    });
})();