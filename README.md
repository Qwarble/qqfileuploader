qqfileuploader
==============
## About
qqfileuploader is modx package. It replaces basic upload manager in Files Tab (not in rich text editors!) by [valum Ajax file uploader](http://valums-file-uploader.github.io/file-uploader/).

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
        this.uploader = new Ext.ux.QQUploadDialog.window({
            source: this.getSource(),
            path: this.cm.activeNode?this.cm.activeNode.attributes.id:this.root.attributes.id
        });
        this.uploader.show();
    }
```
Now when you click "Upload files" button in Files tree tab, valum file uploader will appear.
## Should work
* upload to selected mediasource
* upload to selected catalog
