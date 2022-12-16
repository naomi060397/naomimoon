/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';

/**
 * Import components
 */
import galleryEdit from './edit';
import gallerySave from './save';

registerBlockType("naomimoon/gallery", {
    title: __( "Naomimoon Gallery" ),
    description: __( "Photo Gallery" ),
    icon: 'dashicons dashicons-format-gallery naomimoon-icon',
    category: 'naomimoon',
    attributes: {
        dataArray: {
            type: 'array',
            default: []
        }
    },
    edit: galleryEdit,
    save: gallerySave,
});
