/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { Component, Fragment } from '@wordpress/element';
import { PanelBody, Button, ToggleControl, TextareaControl, Tooltip, RangeControl } from '@wordpress/components';
import { InspectorControls, RichText, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';

/**
 * Export component
 */
export default class heroEdit extends Component {

    render() {
        const { attributes, setAttributes } = this.props;
        const { 
			heading,
        } = attributes;

        return (
            <Fragment>
                <InspectorControls>
					<PanelBody title={__("Settings")} initialOpen={true}>
					</PanelBody>
                </InspectorControls>
				<div className='hero-block container' id="home">
                    hello
				</div>
            </Fragment>
        );
    }
}