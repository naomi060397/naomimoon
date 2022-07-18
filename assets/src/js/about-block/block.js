/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';

/**
 * Import components
 */
import aboutEdit from './edit';
import aboutSave from './save';

registerBlockType("naomimoon/about", {
    title: __( "Naomimoon About" ),
    description: __( "About me" ),
    icon: 'dashicons dashicons-align-full-width naomimoon-icon',
    category: 'naomimoon',
    attributes: {
        heading: {
            type: 'string',
            default: 'About'
        },
        content: {
            type: 'string',
            default: ''
        },
    },
    edit: aboutEdit,
    save: aboutSave,
});
