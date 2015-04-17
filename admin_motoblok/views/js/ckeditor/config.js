/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.filebrowserBrowseUrl = 'http://localhost/motoblok/admin_motoblok/views/js/kcfinder/browse.php?type=files';
  config.filebrowserImageBrowseUrl = 'http://localhost/motoblok/admin_motoblok/views/js/kcfinder/browse.php?type=images';
  config.filebrowserFlashBrowseUrl = 'http://localhost/motoblok/admin_motoblok/views/js/kcfinder/browse.php?type=flash';
  config.filebrowserUploadUrl = 'http://localhost/motoblok/admin_motoblok/views/js/kcfinder/upload.php?type=files';
  config.filebrowserImageUploadUrl = 'http://localhost/motoblok/admin_motoblok/views/js/kcfinder/upload.php?type=images';
  config.filebrowserFlashUploadUrl = 'http://localhost/motoblok/admin_motoblok/views/js/kcfinder/upload.php?type=flash';
};
