<?php
defined('SHOP') or die('Access Denied');
require_once 'header.php';
require_once 'top_menu.php';
require_once 'cat_top_menu.php';
if(!isset($_GET['view']) || ($_GET['view'] != 'cart') && ($_GET['view'] != 'product')) {
	require_once 'leftbar.php';
}
// if(!isset($_GET['view']) || ($_GET['view'] != 'product')) {
// 	require_once 'leftbar.php';
// }
require_once $inc.'.php';
if(isset($_GET['view'])) {
	if($_GET['view'] != 'main' && $_GET['view'] != 'cart') {
		require_once 'rightbar.php';
	}
}
?>
	</div> <!-- #main -->
</div> <!-- #wrapper -->
<div class="clr"></div>
<!-- Footer -->
<?php
require_once 'footer.php';
?>
</body>
</html>