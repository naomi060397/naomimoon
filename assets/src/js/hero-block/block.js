/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';

/**
 * Import components
 */
import heroEdit from './edit';
import heroSave from './save';

registerBlockType("naomimoon/hero", {
    title: __( "Naomimoon Hero" ),
    description: __( "Hero Banner" ),
    icon: 'dashicons dashicons-align-full-width naomimoon-icon',
    category: 'naomimoon',
    attributes: {
        heading: {
            type: 'string',
            default: 'naomi keller'
        },
        subHeading: {
            type: 'string',
            default: 'Developer Portfolio'
        },
        description: {
            type: 'string',
            default: 'WordPress Full-stack | React | PHP | HTML5 | Sass'
        }
    },
    edit: heroEdit,
    save: heroSave,
});
