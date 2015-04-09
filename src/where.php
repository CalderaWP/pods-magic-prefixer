<?php
/**
 * Magically prefixes a Pods where clause
 *
 * @package calderawp\pods_magic_prefix
 * @author    Josh Pollock <Josh@JoshPress.net>
 * @license   GPL-2.0+
 * @link
 * @copyright 2015 Josh Pollock
 */

namespace calderawp\pods_magic_prefix;


class where extends prefixer {

	public function where_clause() {
		return true;
	}

}
