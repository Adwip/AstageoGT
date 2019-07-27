var CKValueEdit=null;
DecoupledEditor.create( document.querySelector( '#ckeditorc2' ),{
                removePlugins: ['ImageUpload' ]
            })
            .then( editor => {
                const toolbarContainer = document.querySelector( '#toolbar-container-edit' );
                CKValueEdit = editor;
                toolbarContainer.appendChild( editor.ui.view.toolbar.element );
            } );
