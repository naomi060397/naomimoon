/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { Component, Fragment } from '@wordpress/element';
import { PanelBody, Button, ToggleControl, TextareaControl } from '@wordpress/components';
import { InspectorControls, RichText, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';

/**
 * Export component
 */
export default class projectEdit extends Component {

    render() {
        const { attributes, setAttributes } = this.props;
        const { 
			heading,
            toggleHeading,
            mediaId,
            descHeading,
            desc,
            layout,
            projectUrl
        } = attributes;

        const leftBorderRad = {borderTopLeftRadius: '10px', borderBottomLeftRadius: '10px'};
        const rightBorderRad = {borderTopRightRadius: '10px', borderBottomRightRadius: '10px'};
        const textAlignRight = {textAlign: 'right'};
		const textAlignLeft = {textAlign: 'left'};
        const flexStyle = {};
        layout && (flexStyle.flexDirection = layout);

        return (
            <Fragment>
                <InspectorControls>
					<PanelBody title={__("Settings")} initialOpen={true}>
						<ToggleControl
							label={__( "Toggle Heading" )}
							checked={toggleHeading}
							onChange={toggleHeading=>setAttributes({toggleHeading})}
						/>
                        <Button
                        className={
                            "naomi-editor-button " +
                            ("row" === layout && "active")
                        }
                        onClick={() => {
                            setAttributes({ layout: "row" });
                        }}
                        >
                        Image on Left
                        </Button>
                        <Button
                        className={
                            "naomi-editor-button " +
                            ("row-reverse" === layout && "active")
                        }
                        onClick={() => {
                            setAttributes({ layout: "row-reverse" });
                        }}
                        >
                        Image on Right
                        </Button>
                        <TextareaControl
                            label="Project URL"
                            help="Enter Project URL"
                            value={ projectUrl }
                            onChange={ ( projectUrl ) => setAttributes({projectUrl}) }
                            className="mt-20"
                        />
					</PanelBody>
                </InspectorControls>
				<div className='project-block container' id="projects">
                {toggleHeading && 
                    <RichText
                        tagName="h2"
                        value={ heading }
                        onChange={ ( heading ) => setAttributes( { heading } ) }
                        placeholder={ __( 'Heading...' ) }
                        className="home-heading"
                    />
                }
                    <div className="row" style={flexStyle}>
                        <div className='col image' style={layout === 'row' ? leftBorderRad : rightBorderRad}>
                        {!mediaId &&
                            <MediaUploadCheck>
                                <MediaUpload
                                    onSelect={ ( media ) =>
                                        setAttributes({ mediaId: media.url })
                                    }
                                    value={ mediaId }
                                    render={ ( { open } ) => (
                                        <Button onClick={ open } className="naomi-mediaupload">Open Media Library</Button>
                                    ) }
                                />
                            </MediaUploadCheck>
                        }
                        {mediaId &&
                            <MediaUploadCheck>
                                <MediaUpload
                                    onSelect={ ( media ) =>
                                        setAttributes({ mediaId: media.url })
                                    }
                                    value={ mediaId }
                                    render={ ( { open } ) => (
                                        <Button onClick={ open } className="naomi-mediaupload replace">Replace Media</Button>
                                    ) }
                                />
                            </MediaUploadCheck>
                        }
                            <a href={projectUrl}><img src={mediaId}></img></a>
                        </div>
                        <div className='col content' style={layout === 'row' ? rightBorderRad : leftBorderRad}>
                            <a href={projectUrl} style={layout !== 'row' ? textAlignRight : textAlignLeft}>
                                <RichText
                                    tagName="h4"
                                    value={ descHeading }
                                    onChange={ ( descHeading ) => setAttributes( { descHeading } ) }
                                    placeholder={ __( 'Heading...' ) }
                                    className="desc-heading"
                                />
                            </a>

                            <RichText
                                tagName="p"
                                value={ desc }
                                onChange={ ( desc ) => setAttributes( { desc } ) }
                                placeholder={ __( 'Description...' ) }
                                className="desc"
                                style={layout !== 'row' ? textAlignRight : textAlignLeft}
                            />
                        </div>
                    </div>
				</div>
            </Fragment>
        );
    }
}