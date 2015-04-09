<?php
/**
 * Base class for orderby/where clauses to inherit.
 *
 * @package calderawp\pods_magic_prefix
 * @author    Josh Pollock <Josh@JoshPress.net>
 * @license   GPL-2.0+
 * @link      
 * @copyright 2015 Josh Pollock
 */

namespace calderawp\pods_magic_prefix;

/**
 * Class prefixer
 *
 * @package calderawp\pods_magic_prefix
 */
abstract class prefixer {

	/**
	 * Prefix field.
	 *
	 * @TODO Make work for where, not just orderby
	 *
	 * @since 1.2.0
	 *
	 * @param string $field_name Name of field to orderby.
	 * @param \Pods|object $pod The Pods object.
	 *
	 * @return string
	 */
	public function prefixer( $field_name, $pod ) {

		$field_type = $this->field_type( $field_name, $pod );
		$pod_type = $this->pod_type( $pod );
		$storage = $pod->pod_data[ 'storage' ];
		if ( ( 'post_type' === $pod_type  && 'post_field' == $field_type ) || ( 'pod' == $pod_type && 'pick' != $field_type ) ) {
			$prefixed = 't.'.$field_name;
		}elseif( 'pick' ==  $field_type ) {
			$prefixed = $field_name;
		}elseif( 'meta' == $storage ) {
			$prefixed = $field_name . '.meta_value';
		}elseif( 'table' == $storage ) {
			$prefixed = 'd.' . $field_name;
		}else{
			$prefixed = $field_name;
		}

		return $prefixed;

	}

	/**
	 * Find field's type.
	 *
	 * @since 1.2.0
	 *
	 * @param string $field_name Name of field to orderby.
	 * @param \Pods|object $pod The Pods object.
	 *
	 * @return string Type of field
	 */
	protected function field_type( $field_name, $pod ) {
		$info = $pod->fields( $field_name );
		$field_type         = pods_v( 'type', $info );

		if ( ! $field_type && ( 'post_type' == $this->pod_type( $pod ) ) ) {
			$field_type = 'post_field';
		}

		return $field_type;
	}

	/**
	 * Get Pod type.
	 *
	 * @since 1.2.0
	 *
	 * @param \Pods|object $pod The Pods object.
	 *
	 * @return string|null
	 */
	protected function pod_type( $pod ) {
		$pod_type = pods_v( 'type', $pod->pod_data );

		return $pod_type;

	}
}
