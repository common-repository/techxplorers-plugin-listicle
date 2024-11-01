<?php
/**
 * This file is part of Techxplorer's Wordpress Utility Library.
 *
 * Techxplorer's Wordpress Utility Library is free software: you can
 * redistribute it and/or modify it under the terms of the GNU General Public
 * License as published by the Free Software Foundation, either version 3 of
 * the License, or (at your option) any later version.
 *
 * Techxplorer's Wordpress Utility Library is distributed in the hope that it
 *  will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty
 *  of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with Techxplorer's Wordpress Utility Library.
 *  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link    https://github.com/techxplorer/txp-wp-utils
 * @since   1.0.0
 * @package Txp_Utils
 */

/**
 * A class containing array related utility functions.
 *
 * @since   1.0.0
 * @package Txp_Utils
 * @author  techxplorer <corey@techxplorer.com>
 */
class Txp_Utils_Array {

	/**
	 * Sorts an array of objects, or arrays, by the specified element in
	 * alphabetical order.
	 *
	 * @param array   $input    The input array of objects or arrays.
	 * @param string  $property The name of the property to sort by.
	 * @param boolean $no_dupes Throw an exception if a duplicate key is found.
	 *
	 * @return array The sorted array.
	 *
	 * @throws InvalidArgumentException If the $input parameter is not an array.
	 * @throws InvalidArgumentException If the $property parameter is not specified.
	 *
	 * @throws RuntimeException If $no_dupes is true and a duplicate property value is discovered.
	 *
	 * @throws UnexpectedValueException If the element of the supplied array is not an object or array.
	 * @throws UnexpectedValueException If an element of the array does not contain the specified property.
	 */
	public static function sort_array_by_element( $input, $property, $no_dupes = true ) {
		// Check the parameters.
		if ( ! is_array( $input ) ) {
			throw new InvalidArgumentException( 'The $input parameter must be an array' );
		}

		if ( count( $input ) <= 1 ) {
			// Nothing to do.
			return $input;
		}

		$property = trim( $property );

		if ( '' === $property ) {
			throw new InvalidArgumentException( 'The $element parameter is required' );
		}

		// Store the array, indexed by the specified property.
		$new_array = array();

		// Loop through the supplied array, processing each element in turn.
		foreach ( $input as $key => $element ) {
			// Is this an object?
			if ( is_object( $element ) ) {
				// Yes.
				if ( false === isset( $element->$property ) ) {
					throw new UnexpectedValueException( "The object at index '$key' did not have property '$property'" );
				}

				$new_key = sanitize_title( $element->$property );

				if ( true === $no_dupes && true === isset( $new_array[ $new_key ] ) ) {
					throw new RuntimeException( "The '$new_key' key from object at index '$key' is a duplicate" );
				}

				$new_array[ $new_key ] = $element;

				// Skip to next element in the input array.
				continue;
			}

			// Is this an array?
			if ( is_array( $element ) ) {
				// Yes.
				if ( false === isset( $element[ $property ] ) ) {
					throw new UnexpectedValueException( "The array at index '$key' did not have key '$property'" );
				}

				$new_key = sanitize_title( $element[ $property ] );

				if ( true === $no_dupes && true === isset( $new_array[ $new_key ] ) ) {
					throw new RuntimeException( "The '$new_key' key from array at index '$key' is a duplicate" );
				}

				$new_array[ $new_key ] = $element;

				// Skip to next element in the input array.
				continue;
			}

			// Throw an exception if we get this far as element was not what was expected.
			throw new UnexpectedValueException( "Expected object or array at index '$key', found '" . gettype( $element ) );
		} // End foreach().

		// Sort the new array.
		if ( false === ksort( $new_array ) ) {
			throw new RuntimeException( 'Unable to sort the new array by key' );
		}

		// Return the new array.
		return $new_array;
	}
}
