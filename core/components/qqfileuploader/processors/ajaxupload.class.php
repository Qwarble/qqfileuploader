<?php
/**
 * Upload files to a directory
 *
 * @param string $path The target directory
 *
 * @package modx
 * @subpackage processors.browser.file
 */
class qqFileUploadProcessor extends modProcessor {
    /** @var modMediaSource $source */
    public $source;
    public function checkPermissions() {
        return $this->modx->hasPermission('file_upload');
    }

    public function getLanguageTopics() {
        return array('file');
    }

    public function initialize() {
        $this->setDefaultProperties(array(
            'source' => 1,
            'path' => false,
        ));
        if (!$this->getProperty('path')) return $this->modx->lexicon('file_folder_err_ns');
        return true;
    }

    public function process() {
        if (!$this->getSource()) {
            return $this->failure($this->modx->lexicon('permission_denied'));
        }
        $this->source->setRequestProperties($this->getProperties());
        $this->source->initialize();
        if (!$this->source->checkPolicy('create')) {
            return $this->failure($this->modx->lexicon('permission_denied'));
        }

        if (isset($_GET['qqfile'])) {            
            $input = fopen("php://input", "r");
            $temp = tmpfile();
            $realSize = stream_copy_to_stream($input, $temp);
            fclose($input);
            
            if (isset($_SERVER["CONTENT_LENGTH"])){
                $size = (int)$_SERVER["CONTENT_LENGTH"];
            } else {
                return $this->failure('getting content-length not supported');
            } 
            if ($realSize != $size){
                return $this->failure('uploaded file size and transfered file sizes are different');
            }
            $bases = $this->source->getBases($this->getProperty('path'));
            $fullPath = $bases['pathAbsolute'].ltrim($this->getProperty('path'),'/');
            $directory = $this->source->fileHandler->make($fullPath);
            if (!($directory instanceof modDirectory)) {
                return $this->failure('folder invalid');
            }

            $newPath = $this->source->fileHandler->sanitizePath($_GET['qqfile']);
            $newPath = $directory->getPath() . $newPath;

            $target = fopen($newPath, "w"); 
            fseek($temp, 0, SEEK_SET);
            stream_copy_to_stream($temp, $target);
            fclose($target);
            $success = 'uploaded';
        } elseif (isset($_FILES['qqfile'])) {
            $success = $this->source->uploadObjectsToContainer($this->getProperty('path'),$_FILES);
        } else {
            return $this->failure('transfer unknown');
        }

        $success = $this->source->uploadObjectsToContainer($this->getProperty('path'),$_FILES);

        if (empty($success)) {
            $msg = '';
            $errors = $this->source->getErrors();
            foreach ($errors as $k => $msg) {
                $this->modx->error->addField($k,$msg);
            }
            return $this->failure($msg);
        }
        return $this->success();
    }

    /**
     * Get the active Source
     * @return modMediaSource|boolean
     */
    public function getSource() {
        $this->modx->loadClass('sources.modMediaSource');
        $this->source = modMediaSource::getDefaultSource($this->modx,$this->getProperty('source'));
        if (empty($this->source) || !$this->source->getWorkingContext()) {
            return false;
        }
        return $this->source;
    }
}
return 'qqFileUploadProcessor';