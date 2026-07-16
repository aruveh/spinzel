import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';

import metadata from '../../../src/BlockMetadata/meta-row/block.json';

registerBlockType(metadata.name, {
	...metadata,

	edit() {
		return (
			<div {...useBlockProps()}>
				<strong>🌍 💰 👥 A9 Meta Row</strong>
			</div>
		);
	},

	save() {
		return null;
	},
});