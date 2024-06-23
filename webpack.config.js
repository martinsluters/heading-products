const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );
module.exports = {
	...defaultConfig,
	entry: {
		'heading-products': './includes/block-editor/blocks/heading-products',
	},
};
