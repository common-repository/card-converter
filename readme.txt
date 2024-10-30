=== Card Converter ===
Contributors: nickmomrik
Tags: cards, poker, convert
Stable tag: 2.0
Tested up to: 4.4

Replace playing card abbreviations with a CSS playing card.

== Installation ==
1. Upload card-converter.php to your wp-content/plugins/ directory.
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to Options->Discussion. Add `<span` and `</span>` to the Comment Moderation list. In order for the plugin to work correctly, the allowed_tags had to be overwritten. Now if anyone attempts to use a span tag in comments, you will have to approve it first.
1. Whenever you want to display a playing card in a post or comment, wrap one card abbreviation between `<card>` and `</card>` tags.

== Notes ==
* Make sure to only use one card abbreviation in between each set of tags. If you want to display multiple cards, you will need to use multiple tags. This was done to allow unsuited cards and unranked cards to be used.
* Uppercase and lowercase letters are both allowed for card abbreviations.
* 10 is converted to T.
* 1 is converted to A.
* Both ? and X are allowed for card ranks. ? means you have no idea what a card was. X is meant for any "rag," such as when people use the term AX suited they mean they had an Ace and a rag both of the same suit.
* Unsuited cards are allowed.
* Unranked suits are allowed. X will be used as the card rank.
* I tested using `<CARD>` as the tag and WP automatically converted it to lowercase.
* Using anything other than letters, numbers, or ? inside the tags will cause the plugin to skip over it.

== Screenshots ==

1. Output of the examples

== Examples ==
* Rank & Suit
`<card>Ac</card><card>Ad</card>`
`<card>KC</card><card>TC</card>`
* Unsuited
`<card>8</card><card>j</card><card>?</card>`
* Unranked
`<card>C</card><card>h</card>`
* Invalid cards
`<card>V</card>`
`<card>0</card>`
`<card>Ph</card>`
`<card>Eb</card>`
`<card>ch</card>`
`<card>1ds</card>`
