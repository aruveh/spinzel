import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';

import metadata from '../../../src/BlockMetadata/views/block.json';

registerBlockType(metadata.name, {
	...metadata,

	edit() {
		return (
			<div {...useBlockProps()}>
				<strong>👁 A9 Views</strong>
			</div>
		);
	},

	save() {
		return null;
	},
});