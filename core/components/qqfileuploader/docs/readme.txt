This extra replace default file manager in Files tree tab by valum ajax file uploader (http://valums-file-uploader.github.io/file-uploader/).
!!! IMPORTANT!!!
After installation you must replace function uploadFiles in "manager/assets/modext/widgets/system/modx.tree.directory.js":

### code start ###
,uploadFiles: function(btn,e) {
        
}
### code end ###

By this one:

### code start ###
,uploadFiles: function(btn,e) {
        this.uploader = new Ext.ux.QQUploadDialog.window({
            source: this.getSource(),
            path: this.cm.activeNode?this.cm.activeNode.attributes.id:this.root.attributes.id
        });
        this.uploader.show();
    }
### code end ###