/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { registerBlockType } from '@wordpress/blocks';

/**
 * Import components
 */
import projectEdit from './edit';
import projectSave from './save';

registerBlockType("naomimoon/project", {
    title: __( "Naomimoon Projects" ),
    description: __( "2 Column block" ),
    icon: 'format-image',
    category: 'naomimoon',
    attributes: {
        heading: {
            type: 'string',
            default: ''
        },
        toggleHeading: {
            type: 'boolean',
            default: true
        },
        mediaId: {
            type: 'string',
            default: ''
        },
        descHeading: {
            type: 'string',
            default: ''
        },
        desc: {
            type: 'string',
            default: ''
        },
        layout: {
            type: 'string',
            default: 'row'
        },
        projectUrl: {
            type: 'string',
            default: ''
        },

    },
    edit: projectEdit,
    save: projectSave,
});

