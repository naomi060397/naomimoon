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
export default class linkEdit extends Component {

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
                value: '',
                icon: '',
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
            value: '',
            icon: '',
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
            avatar,
            toggleAvatar,
			heading,
            subHeading,
            toggleHeading,
            toggleSubheading,
            dataArray,
            itemPadding,
            itemGap,
        } = attributes;

        const itemStyles = {};
        itemPadding && (itemStyles.padding = itemPadding + "px 27px");

        const itemContainerStyles = {};
        itemGap && (itemContainerStyles.gap = itemGap + "px");

        const linkListing = dataArray?.map((data, index) => {
            return(
                <Fragment>
                    <div className="col">
                        <RichText
                            tagName="p"
                            value={data.value}
                            placeholder={__( "Enter Text..." )}
                            onChange={value => {
                                let arrayCopy = [...dataArray];
                                arrayCopy[index].value = value;
                                setAttributes({ dataArray: arrayCopy });
                            }}
                            style={itemStyles}
                        />
                        <div className='image'>
                        {!data.icon &&
                            <MediaUploadCheck>
                                <MediaUpload
                                    onSelect={ ( media ) => {
                                        let arrayCopy = [...dataArray];
                                        arrayCopy[index].icon = media.url;
                                        setAttributes({ dataArray: arrayCopy });
                                    }}
                                    value={ data.icon }
                                    render={ ( { open } ) => (
                                        <Button onClick={ open } className="naomi-mediaupload" style={{right: "27px"}}>Add Icon</Button>
                                    ) }
                                />
                            </MediaUploadCheck>
                        }
                        {data.icon &&
                            <MediaUploadCheck>
                                <MediaUpload
                                    onSelect={ ( media ) => {
                                        let arrayCopy = [...dataArray];
                                        arrayCopy[index].icon = media.url;
                                        setAttributes({ dataArray: arrayCopy });
                                    }}
                                    value={ data.icon }
                                    render={ ( { open } ) => (
                                        <Button onClick={ open } className="naomi-mediaupload replace">Replace Icon</Button>
                                    ) }
                                />
                            </MediaUploadCheck>
                        }
                            <img class="link-item-icon" src={data.icon}></img>
                        </div>
                        <div className="item-action-wrap">
                            <div className="move-item">
                                {0 < index && (
                                <Tooltip text={__( "Move Up" )}>
                                    <i 
                                        className="dashicons dashicons-arrow-up-alt2" 
                                        onClick={()=>this.moveItem(index, index - 1)}
                                        aria-hidden="true"
                                    ></i>
                                </Tooltip>
                                )}
                                {index + 1 < dataArray.length && (
                                <Tooltip text={__( "Move Down" )}>
                                    <i 
                                        className="dashicons dashicons-arrow-down-alt2" 
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
            );
        });

        return (
            <Fragment>
                <InspectorControls>
					<PanelBody title={__("Display")} initialOpen={true}>
                        <ToggleControl
							label={__( "Toggle Avatar" )}
							checked={toggleAvatar}
							onChange={toggleAvatar=>setAttributes({toggleAvatar})}
						/>
						<ToggleControl
							label={__( "Toggle Heading" )}
							checked={toggleHeading}
							onChange={toggleHeading=>setAttributes({toggleHeading})}
						/>
                        <ToggleControl
							label={__( "Toggle Subheading" )}
							checked={toggleSubheading}
							onChange={toggleSubheading=>setAttributes({toggleSubheading})}
						/>
					</PanelBody>
                    <PanelBody title={__("Style")} initialOpen={true}>
                        <RangeControl
                            label="Item Padding"
                            value={ itemPadding }
                            onChange={ ( itemPadding ) => setAttributes({ itemPadding }) }
                            min={ 12 }
                            max={ 25 }
                            step={ .2 }
                        />
                        <RangeControl
                            label="Item Margin"
                            value={ itemGap }
                            onChange={ ( itemGap ) => setAttributes({ itemGap }) }
                            min={ 12 }
                            max={ 25 }
                            step={ .2 }
                        />
                    </PanelBody>
                </InspectorControls>
				<div className='link-block' id="links">
                    <div className='container'>
                        <div className='link-card'>
                        {toggleAvatar &&
                            <div className="link-avatar">
                                {!avatar &&
                                    <MediaUploadCheck>
                                        <MediaUpload
                                            onSelect={ ( media ) =>
                                                setAttributes({ avatar: media.url })
                                            }
                                            value={ avatar }
                                            render={ ( { open } ) => (
                                                <Button onClick={ open } className="naomi-mediaupload replace">Add Avatar</Button>
                                            ) }
                                        />
                                    </MediaUploadCheck>
                                }
                                {avatar &&
                                    <MediaUploadCheck>
                                        <MediaUpload
                                            onSelect={ ( media ) =>
                                                setAttributes({ avatar: media.url })
                                            }
                                            value={ avatar }
                                            render={ ( { open } ) => (
                                                <Button onClick={ open } className="naomi-mediaupload replace">Replace</Button>
                                            ) }
                                        />
                                    </MediaUploadCheck>
                                }
                                <img src={avatar}></img>
                            </div>
                        }
                        {toggleHeading && 
                            <div className="link-heading">
                                <RichText
                                    tagName="h2"
                                    value={ heading }
                                    onChange={ ( heading ) => setAttributes( { heading } ) }
                                    placeholder={ __( 'Heading...' ) }
                                />
                            </div>
                        }
                        {toggleSubheading && 
                            <div className="link-subheading">
                                <RichText
                                    tagName="h4"
                                    value={ subHeading }
                                    onChange={ ( subHeading ) => setAttributes( { subHeading } ) }
                                    placeholder={ __( 'Sub Heading...' ) }
                                />
                            </div>
                        }
                            <div className="row" style={itemContainerStyles}>
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
                        <div className="link-footer">
                            <i>Created with <a href="https://wordpress.org/">WordPress</a></i>
                        </div>
                    </div>
				</div>
            </Fragment>
        );
    }
}