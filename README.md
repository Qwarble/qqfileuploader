qqfileuploader
==============
## About
qqfileuploader is ajax file uploader for modx package. It replaces basic upload file window in Files Tab or file manager  by [valum Ajax file uploader](http://valums-file-uploader.github.io/file-uploader/).

![Files tree](http://s29.postimg.org/phcivdv7b/2014_03_03_18_42_13_System_Settings_MODX_Revol.png)
![File manager](http://s29.postimg.org/amnxh7lmf/2014_03_03_18_44_35_Editing_Home_MODX_Revolut.png)
## Installation
At first install qqfileuploader package through modx package manager. Then modify file "/manager/assets/modext/widgets/system/modx.tree.directory.js"
Replace function "uploadFiles".

Original function:
```javascript
    ,uploadFiles: function(btn,e) {
        if (!this.uploader) {
            this.uploader = new Ext.ux.UploadDialog.Dialog({
                url: MODx.config.connectors_url+'browser/file.php'
                ,base_params: {
                    action: 'upload'
                    ,wctx: MODx.ctx || ''
                    ,source: this.getSource()
                }
                ,reset_on_hide: true
                ,width: 550
                ,cls: 'ext-ux-uploaddialog-dialog modx-upload-window'
            });
            this.uploader.on('show',this.beforeUpload,this);
            this.uploader.on('uploadsuccess',this.uploadSuccess,this);
            this.uploader.on('uploaderror',this.uploadError,this);
            this.uploader.on('uploadfailed',this.uploadFailed,this);
        }
        this.uploader.base_params.source = this.getSource();
        this.uploader.show(btn);
    }
```

new one:
```javascript
    ,uploadFiles: function(btn,e) {
        if (!this.uploader) {
            this.uploader = new Ext.ux.QQUploadDialog.window;

            this.uploader.on('show',this.beforeUpload,this);
            this.uploader.on('uploadsuccess',this.uploadSuccess,this);
            this.uploader.on('uploaderror',this.uploadError,this);
            this.uploader.on('uploadfailed',this.uploadFailed,this);
        }
        
        this.uploader.show(btn);
    }
```
Now when you click "Upload files" button in Files tree tab or in file manager, valum file uploader will appear.
## Should work
* upload to selected mediasource
* upload to selected catalog
