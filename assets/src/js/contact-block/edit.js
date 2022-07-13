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
export default class contactEdit extends Component {

    componentDidMount() {
        const { attributes } = this.props;
        const { dataArray } = attributes;
        if (0 === dataArray.length) {
            this.initList();
        }
    }

    /**
     * Set up list array
     */
    initList() {
        const { setAttributes, attributes } = this.props;
        const { dataArray } = attributes;
        setAttributes({
            dataArray: [
                {
                    index: 0,
                    url: '',
                    icon: '',
                    iconId: '',
                    iconAlt: '',
                    title: '',
                }
            ]
        });
    }

    /**
     * Add new list item
     */
    addNewItem() {
        const { setAttributes, attributes } = this.props;
        const { dataArray } = attributes;
        let attr = {
            index: dataArray.length,
            url: '',
            icon: '',
            iconId: '',
            iconAlt: '',
            title: '',
        }
        setAttributes({ 
            dataArray: [...dataArray, attr]
        });
    }

    /**
     * Change item order in array
     * 
     * @param {number} oldIndex 
     * @param {number} newIndex 
     */
    moveItem(oldIndex, newIndex) {
        const { attributes, setAttributes } = this.props;
        const { dataArray } = attributes;

        let arrayCopy = [...dataArray]

        arrayCopy[oldIndex] = dataArray[newIndex]
        arrayCopy[newIndex] = dataArray[oldIndex]

        setAttributes({
            dataArray: arrayCopy
        });
    }

    render() {
        const { attributes, setAttributes } = this.props;
        const { 
			heading,
            toggleHeading,
            dataArray,
            flexWidth
        } = attributes;

        const flexStyle = {};
        flexWidth && (flexStyle.flex = '0 0 ' + flexWidth + '%');

        const getImageButton = (openEvent, index) => {
            if (dataArray[index].icon) {
                return (
                    <a href={dataArray[index].url}>
                        <img
                            src={dataArray[index].icon}
                            alt={dataArray[index].iconAlt}
                            loading="lazy"
                            height="40px"
                            width="40px"
                        />
                    </a>
                );
            } else {
                return (
                    <Button onClick={openEvent} className="naomi-mediaupload">
                        {__("Upload Icon")}
                    </Button>
                );
            }
          };

        const linkListing = dataArray?.map((data, index) => {
            return(
                <Fragment>
                    <div className="col" style={flexStyle}>
                        <MediaUploadCheck>
                            <MediaUpload
                                onSelect={(e) => {
                                    let arrayCopy = [...dataArray];
                                    arrayCopy[index].icon = e.url;
                                    arrayCopy[index].iconId = e.id;
                                    arrayCopy[index].iconAlt = e.alt;
                                    setAttributes({
                                        dataArray: arrayCopy,
                                    });
                                }}
                                allowedTypes={"image"}
                                value={data.iconId}
                                render={({ open }) => getImageButton(open, index)}
                            />
                        </MediaUploadCheck>
                        {data.icon &&
                            <MediaUploadCheck>
                                <MediaUpload
                                    onSelect={(e) => {
                                        let arrayCopy = [...dataArray];
                                        arrayCopy[index].icon = e.url;
                                        arrayCopy[index].iconId = e.id;
                                        arrayCopy[index].iconAlt = e.alt;
                                        setAttributes({
                                            dataArray: arrayCopy,
                                        });
                                    }}
                                    allowedTypes={"image"}
                                    value={data.iconId}
                                    render={({ open }) => (
                                        <Tooltip
                                            text={__("Change Image")}
                                            position="top center"
                                        >
                                            <span
                                                onClick={open}
                                                className="dashicons dashicons-edit"
                                            ></span>
                                        </Tooltip>
                                    )}
                                />
                            </MediaUploadCheck>
                        }
                        <RichText
                            tagName="h4"
                            value={data.title}
                            placeholder={__( "Enter Title" )}
                            onChange={value => {
                                let arrayCopy = [...dataArray];
                                arrayCopy[index].title = value;
                                setAttributes({dataArray: arrayCopy});
                            }}
                            className="contact-title"
                        />
                        <RichText
                            tagName="p"
                            value={data.url}
                            placeholder={__( "Enter URL" )}
                            onChange={value => {
                                let arrayCopy = [...dataArray];
                                arrayCopy[index].url = value;
                                setAttributes({dataArray: arrayCopy});
                            }}
                            className="contact-url-input"
                        />
                        <div className="item-action-wrap">
                            <div className="move-item">
                                {0 < index && (
                                <Tooltip text={__( "Move Left" )}>
                                    <i 
                                        className="dashicons dashicons-arrow-left-alt2" 
                                        onClick={()=>this.moveItem(index, index - 1)}
                                        aria-hidden="true"
                                    ></i>
                                </Tooltip>
                                )}
                                {index + 1 < dataArray.length && (
                                <Tooltip text={__( "Move Right" )}>
                                    <i 
                                        className="dashicons dashicons-arrow-right-alt2" 
                                        onClick={()=>this.moveItem(index, index + 1)}
                                        aria-hidden="true"
                                    ></i>
                                </Tooltip>
                                )}
                            </div>
                            <Tooltip text={__( "Remove Item" )}>
                                <i 
                                    className='dashicons dashicons-no-alt remove-item'
                                    onClick={() => {
                                        let toDelete = confirm('Are you sure you want to delete this item?');
                                        if ( true === toDelete ) {
                                            const updatedArray = dataArray.filter(item => item.index != data.index).map(updatedItems => {
                                                if ( updatedItems.index > data.index ) {
                                                updatedItems.index -= 1
                                                }
                                                return updatedItems
                                            })
                                            setAttributes({dataArray: updatedArray})
                                        }
                                    }}
                                ></i>
                            </Tooltip>
                        </div>
                    </div>
                </Fragment>
            )
        });

        return (
            <Fragment>
                <InspectorControls>
					<PanelBody title={__("Settings")} initialOpen={true}>
						<ToggleControl
							label={__( "Toggle Heading" )}
							checked={toggleHeading}
							onChange={toggleHeading=>setAttributes({toggleHeading})}
						/>
                        <RangeControl 
                            label="Flex Width"
                            value={ flexWidth }
                            onChange={ ( flexWidth ) => setAttributes({ flexWidth }) }
                            min={ 5 }
                            max={ 100 }
                        />
					</PanelBody>
                </InspectorControls>
				<div className='contact-block container' id="contact">
                {toggleHeading && 
                    <div>
                        <RichText
                            tagName="h2"
                            value={ heading }
                            onChange={ ( heading ) => setAttributes( { heading } ) }
                            placeholder={ __( 'Heading...' ) }
                            className="home-heading"
                        />
                        <span className="naomimoon-border-bottom"></span>
                    </div>
                }
                    <div className="row contact-row">
                        {linkListing}
                    </div>
                    <div className="add-item-wrap">
                        <Tooltip text={__( "Add New Item" )}>
                        <i
                            className="dashicons dashicons-plus-alt2"
                            aria-hidden="true"
                            onClick={() => {
                            this.addNewItem();
                            }}
                        ></i>
                        </Tooltip>
                    </div>
				</div>
            </Fragment>
        );
    }
}