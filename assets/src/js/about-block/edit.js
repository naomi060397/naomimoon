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
export default class aboutEdit extends Component {

    render() {
        const { attributes, setAttributes } = this.props;
        const { 
			heading,
            content
        } = attributes;

        return (
            <Fragment>
                <InspectorControls>
                </InspectorControls>
                <div className="about-block naomimoon-homepage__about container" id="about">
                    <div className="square-border">
                        <RichText
                            tagName="h1"
                            value={ heading }
                            onChange={ ( heading ) => setAttributes( { heading } ) }
                            placeholder={ __( 'Heading...' ) }
                            className="home-heading mb-10"
                        />
                        <span class="naomimoon-border-bottom"></span>
                        <RichText
                            tagName="p"
                            value={ content }
                            onChange={ ( content ) => setAttributes( { content } ) }
                            placeholder={ __( 'Content...' ) }
                            className="pb-40 pt-25"
                        />
                    </div>
                </div>
            </Fragment>
        );
    }
}