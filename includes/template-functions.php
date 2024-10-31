<?php
namespace Reviewer_Rich_Snippets;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/**************************************************************
 * Template hooks
 *************************************************************/

/**
 * Add template hooks.
 *
 * Add the hooks for the set actions in the template files and attach
 * the related template parts to the templates.
 *
 * @since 1.0.0
 */
function template_hooks() {

	add_action( 'reviewer\review\head', '\Reviewer_Rich_Snippets\rich_snippet_markup' );

}
add_action( 'init', '\Reviewer_Rich_Snippets\template_hooks' );


/**
 * Output markup.
 *
 * Prepare and output the rich snippet markup.
 *
 * @since 1.0.0
 */
function rich_snippet_markup() {

	global $post;

	$review = new \Reviewer\Review( $post->ID );

	$markup = apply_filters( 'reviewer_rich_snippets\markup', array(
		'itemReviewed'  => $review->post_title, // Required
		'description'   => $review->post_excerpt, // Required
		'author'        => $review->get_author_name(),
		'datePublished' => $review->post_date, // Required
//		'inLanguage' => '', // Recommended
//		'publisher' => array(
//			'name' => '',
//			'sameAs' => '',
//		), // Required
		'reviewRating'  => array(
			'type'   => 'Rating',
			'values' => array(
				'bestRating'  => $review->get_max_rating(),
				'worstRating' => 1,
				'ratingValue' => $review->get_rating(),
			),
		),
//		'aggregateRating' => array(
//			'type' => '',
//			'values' => array(
//				'aggregateRating.bestRating' => '',
//				'aggregateRating.worstRating' => '',
//				'aggregateRating.ratingValue' => '',
//				'aggregateRating.ratingCount' => '',
//			),
//		),
		'URL'           => get_permalink( $review->id ),
	), $review );


	?><div itemprop="review" itemscope itemtype="http://schema.org/Review"><?php

		foreach ( $markup as $k => $v ) {

			if ( ! is_array( $v ) ) {
				?><meta itemprop="<?php echo $k; ?>" content="<?php echo $v; ?>"><?php
			} elseif ( is_array( $v ) ) {

				?><div itemprop="<?php echo $k; ?>" itemscope itemtype="http://schema.org/<?php echo $v['type']; ?>"><?php
					foreach ( $v['values'] as $k2 => $v2 ) {
						?><meta itemprop="<?php echo $k2; ?>" content="<?php echo $v2; ?>"><?php
					}
				?></div><?php
			}

		}

	?></div><?php

}
