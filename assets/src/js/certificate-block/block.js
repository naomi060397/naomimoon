/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';

/**
 * Import components
 */
import certificateEdit from './edit';
import certificateSave from './save';

registerBlockType("naomimoon/certificate", {
    title: __( "Naomimoon Certificates" ),
    description: __( "List block" ),
    icon: 'dashicons dashicons-welcome-learn-more',
    category: 'naomimoon',
    attributes: {
        heading: {
            type: 'string',
            default: 'Certifications'
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
    edit: certificateEdit,
    save: certificateSave,
});

