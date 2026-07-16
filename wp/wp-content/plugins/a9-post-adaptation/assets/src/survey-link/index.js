import { registerBlockType } from '@wordpress/blocks';
import {
    useBlockProps,
    InspectorControls
} from '@wordpress/block-editor';

import {
    PanelBody,
    TextControl
} from '@wordpress/components';

import metadata from '../../../src/BlockMetadata/survey-link/block.json';

registerBlockType(metadata.name, {
    ...metadata,

    edit({ attributes, setAttributes }) {

        const { label } = attributes;

        return (
            <>
                <InspectorControls>
                    <PanelBody title="Survey Link">
                        <TextControl
                            label="Link Text"
                            value={label}
                            onChange={(value) =>
                                setAttributes({
                                    label: value,
                                })
                            }
                        />
                    </PanelBody>
                </InspectorControls>

                <div {...useBlockProps()}>
                    🔗 {label || 'Open Survey'}
                </div>
            </>
        );
    },

    save() {
        return null;
    },
});