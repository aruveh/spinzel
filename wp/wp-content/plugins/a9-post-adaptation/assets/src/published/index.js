import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';

import metadata from '../../../src/BlockMetadata/published/block.json';

registerBlockType(metadata.name, {
	...metadata,

	edit() {
		return (
			<div {...useBlockProps()}>
				<strong>📅 A9 Published Date</strong>
			</div>
		);
	},

	save() {
		return null;
	},
});