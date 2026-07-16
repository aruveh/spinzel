import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';

import metadata from '../../../src/BlockMetadata/survey-status/block.json';

registerBlockType(metadata.name, {
    ...metadata,

    edit() {
        return (
            <div {...useBlockProps()}>
                <strong>📊 A9 Survey Status</strong>
            </div>
        );
    },

    save() {
        return null;
    },
});