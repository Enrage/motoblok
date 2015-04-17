<?php
class add_page extends Core_Admin {
	public function get_content() {
		if($_POST) {
			$res = $this->m->add_page();
		}
	}

	protected function session_pages() {
		$position = isset($_SESSION['add_page']['position']) ? $_SESSION['add_page']['position'] : NULL;
		$keywords = isset($_SESSION['add_page']['keywords']) ? htmlspecialchars($_SESSION['add_page']['keywords']) : NULL;
		$description = isset($_SESSION['add_page']['description']) ? htmlspecialchars($_SESSION['add_page']['description']) : NULL;
		$text = isset($_SESSION['add_page']['text']) ? $_SESSION['add_page']['text'] : NULL;
		$pages[] = $position;
		$pages[] = $keywords;
		$pages[] = $description;
		$pages[] = $text;
		return $pages;
	}
}
?>