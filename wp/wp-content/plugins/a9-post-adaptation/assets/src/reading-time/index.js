import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';

import metadata from '../../../src/BlockMetadata/reading-time/block.json';

registerBlockType(metadata.name, {
	...metadata,

	edit() {
		return (
			<div {...useBlockProps()}>
				<strong>⏱️ A9 Reading Time</strong>
			</div>
		);
	},

	save() {
		return null;
	},
});