/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';

/**
 * Import components
 */
import linkEdit from './edit';
import linkSave from './save';

registerBlockType("naomimoon/links", {
    title: __( "Naomimoon Link Block" ),
    description: __( "List block" ),
    icon: 'dashicons dashicons-admin-links naomimoon-icon',
    category: 'naomimoon',
    attributes: {
        heading: {
            type: 'string',
            default: 'Naomi Moon'
        },
        subHeading: {
            type: 'string',
            default: 'she/her'
        },
        toggleHeading: {
            type: 'boolean',
            default: true
        },
        dataArray: {
            type: 'array',
            default: []
        },
    },
    edit: linkEdit,
    save: linkSave,
});

