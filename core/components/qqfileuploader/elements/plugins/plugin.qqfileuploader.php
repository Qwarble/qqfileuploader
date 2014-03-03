<?php
/**
 *
 * Events: OnManagerPageBeforeRender
 *
 * @author Alexey Barsukov <barsaa(at)mail.ru>
 *
 * @package qqfileuploader
 */

$assetsUrl = $modx->getOption('qqfileuploader.assets_url',$config,$modx->getOption('assets_url').'components/qqfileuploader/');
$modx->controller->addLexiconTopic('qqfileuploader:default');
$modx->controller->addJavascript($assetsUrl.'mgr/js/widgets/qquploaddialog.js');
$modx->controller->addCss($assetsUrl.'mgr/css/fileuploader.css');
$modx->controller->addHtml('<script>var qqfileuploader = {}; Ext.onReady(function() {qqfileuploader.connectorUrl=\''.$assetsUrl.'connector.php\';});</script>');