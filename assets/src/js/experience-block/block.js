/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';

/**
 * Import components
 */
import experienceEdit from './edit';
import experienceSave from './save';

registerBlockType("naomimoon/experience", {
    title: __( "Naomimoon Experience" ),
    description: __( "List block" ),
    icon: 'dashicons ddashicons-table-row-after',
    category: 'naomimoon',
    attributes: {
        heading: {
            type: 'string',
            default: 'Experience'
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
    edit: experienceEdit,
    save: experienceSave,
});

