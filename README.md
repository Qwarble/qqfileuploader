qqfileuploader
==============
## About
qqfileuploader is ajax file uploader for modx package. It replaces basic upload file window in Files Tab or file manager  by [valum Ajax file uploader](http://valums-file-uploader.github.io/file-uploader/).

![Files tree](https://www.dropbox.com/s/pxd58yztqbymgiu/2014-03-03%2018_42_13-System%20Settings%20_%20MODX%20Revolution.png)
![File manager](https://www.dropbox.com/s/j1e86j9b7duu2lj/2014-03-03%2018_44_35-Editing_%20Home%20_%20MODX%20Revolution.png)
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
Now when you click "Upload files" button in Files tree tab or in file manager, valum file uploader will appear.
## Should work
* upload to selected mediasource
* upload to selected catalog
