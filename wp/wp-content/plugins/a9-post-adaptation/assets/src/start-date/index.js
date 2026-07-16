import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';

import metadata from '../../../src/BlockMetadata/start-date/block.json';

registerBlockType(metadata.name, {
	...metadata,

	edit() {
		return (
			<div {...useBlockProps()}>
				<strong>📅 A9 Start Date</strong>
			</div>
		);
	},

	save() {
		return null;
	},
});