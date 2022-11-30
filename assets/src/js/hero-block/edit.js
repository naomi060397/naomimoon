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
            subHeading,
            description
        } = attributes;

        return (
            <Fragment>
                <InspectorControls>
                </InspectorControls>
                <div className="hero-block naomimoon-portfolio__hero align-center" id="portfolio">
                    <div className="overlay-wrapper"></div>
                    <div className="hero-card">
                        <RichText
                            tagName="h1"
                            value={ heading }
                            onChange={ ( heading ) => setAttributes( { heading } ) }
                            placeholder={ __( 'Heading...' ) }
                        />
                        <span className="naomimoon-border-bottom"></span>
                        <RichText
                            tagName="h3"
                            value={ subHeading }
                            onChange={ ( subHeading ) => setAttributes( { subHeading } ) }
                            placeholder={ __( 'Sub Heading...' ) }
                        />
                        <RichText
                            tagName="h4"
                            value={ description }
                            onChange={ ( description ) => setAttributes( { description } ) }
                            placeholder={ __( 'Description...' ) }
                        />
                    </div>
                </div>
            </Fragment>
        );
    }
}