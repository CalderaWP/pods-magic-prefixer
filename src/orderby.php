<?php
/**
 * Magically prefixes a Pods orderby clause
 *
 * @package calderawp\pods_magic_prefix
 * @author    Josh Pollock <Josh@JoshPress.net>
 * @license   GPL-2.0+
 * @link      
 * @copyright 2015 Josh Pollock
 */

namespace calderawp\pods_magic_prefix;

/**
 * Class orderby
 *
 * @package calderawp\pods_magic_prefix
 */
class orderby extends prefixer {
	/**
	 * Create the orderby field, with prefix and possible casting.
	 *
	 * @since 1.2.0
	 *
	 * @param string $orderby_field Name of field to orderby
	 * @param string $orderby_direction Direction to order
	 * @param \Pods|object $pod The Pods object.
	 *
	 * @return string Prepared orderby statement.
	 */
	public function orderby_clause( $orderby_field, $orderby_direction, $pod ) {
		if ( ! in_array( $orderby_direction, array( 'ASC', 'DESC' ) ) ) {
			$orderby_direction = 'ASC';
		}

		$field_type = $this->field_type( $orderby_field, $pod );

		if ( $field_type ) {
			switch ( $field_type ) {
				case 'number' == $field_type :
					$orderby_field = sprintf( 'CAST( %1s AS DECIMAL )', $this->prefixer( $orderby_field, $pod ) );
					break;
				case 'date' == $field_type :
					$orderby_field = sprintf( 'CAST( %1s AS DATE )', $this->prefixer( $orderby_field, $pod ) );
					break;
				default :
					$orderby_field = $this->prefixer( $orderby_field, $pod );
					break;
			}
		}

		$orderby = $orderby_field . ' ' . $orderby_direction;

		return $orderby;

	}

}
