var CKValue=null;
DecoupledEditor.create( document.querySelector( '#ckeditorc' ),{
                removePlugins: ['ImageUpload' ]
            })
            .then( editor => {
                const toolbarContainer = document.querySelector( '#toolbar-container' );
                CKValue = editor;
                toolbarContainer.appendChild( editor.ui.view.toolbar.element );
            } );
