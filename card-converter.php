<?php
/*
Plugin Name: Card Converter
Plugin URI: https://wordpress.org/plugins/card-converter/
Description: Replace playing card abbreviations with a CSS playing card. Allows you to write &lt;card&gt;As&lt;/card&gt;, but display a CSS representation of the Ace of spades.
Author: Nick Momrik
Version: 2.0
Author URI: http://nickmomrik.com/
*/ 

function mdv_card_converter( $text ) {
	// Check what is in between <card> and </card>.
	$output = preg_replace( "'<card>([a-zA-Z0-9\?]*)</card>'e", "mdv_convert_card('\\1')", $text );

	return $output;
}

function mdv_valid_card( $card ) {
	$len = strlen( $card );

	//No suit
	if ( 1 == $len ) {
		$output = '<span class="nocardsuit">' . $card . '&nbsp;</span>';
	} else {
		// Suited card
		$suit = substr( $card, 1, 1 );

		// Red suit
		if ( preg_match( "/[DH]/", $suit ) ) {
			$card = preg_replace( "/D/", "&diams;", $card );
			$card = preg_replace( "/H/", "&hearts;", $card );
			$output = '<span class="redcardsuit">' . $card . '</span>';
		} else {
			// Black suit
			$card = preg_replace( "/C/", "&clubs;", $card );
			$card = preg_replace( "/S/", "&spades;", $card );
			$output = '<span class="blackcardsuit">' . $card . '</span>';
		}
	}
	
	return $output;
}

function mdv_convert_card( $card ) {
	$invalid_message = "[invalid card]";
	$inv = '<span class="invalidcard">' . $invalid_message . '</span>';

	// Make some format changes to the input
	$card = strtoupper( $card );
	$card = str_replace( "10", "T", $card );
	$card = str_replace( "1", "A", $card );

	$len = strlen( $card );
	if ( 1 == $len ) {
		if ( preg_match( "/[2-9TJQKAX\?]/", $card ) ) {
			// Unsuited card
			$output = mdv_valid_card($card);
		} elseif ( preg_match( "/[CDHS]/", $card ) ) {
			//Suit w/o card rank
			$card = "X" . $card;
			$output = mdv_valid_card( $card );
		} else {
			$output = $inv;
		}
	} elseif (2 == $len ) {
		if ( preg_match( "/[2-9TJQKAX\?][CDHS]/", $card ) ) {
			$output = mdv_valid_card( $card );
		} else {
			$output = $inv;
		}
	} else {
		$output = $inv;
	}

	return $output;
}

function mdv_card_converter_css() {
	// Adds CSS to head
?>
	<style type='text/css'>
		.redcardsuit, .blackcardsuit, .nocardsuit, .invalidcard {
			padding: 0px 1px 0px 1px;
			margin: 0px 1px 0px 1px;
			background-color:#ffc;
			border:1px solid #888;
			font: 15px Courier;
			line-height: 150%;
		}
		.redcardsuit {
			color: red;
		}
		.blackcardsuit {
			color: black;
		}
		.nocardsuit {
			color: blue;
		}
	</style>
<?php
}

function mdv_allow_card_tag() {
	global $allowedtags, $allowedposttags;

	define( 'CUSTOM_TAGS', true );

	$allowedtags['card'] = array();
	$allowedposttags['card'] = array();
}

add_filter( 'the_content', 'mdv_card_converter' );
add_filter( 'the_excerpt', 'mdv_card_converter' );
add_filter( 'comment_text', 'mdv_card_converter', 9 );
add_action( 'wp_head', 'mdv_card_converter_css' );
add_action( 'init', 'mdv_allow_card_tag' );
