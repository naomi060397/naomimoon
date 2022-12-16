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
export default class galleryEdit extends Component {

    componentDidMount() {
        const { attributes } = this.props;
        const { dataArray } = attributes;
        if (0 === dataArray.length) {
            this.initList();
        }
    }

    initList() {
        const { setAttributes, attributes } = this.props;
        const { dataArray } = attributes;
        setAttributes({
            dataArray: [
                {
                    index: 0,
                    value: '',
                }
            ]
        });
    }

    addNewItem() {
        const { setAttributes, attributes } = this.props;
        const { dataArray } = attributes;
        let attr = {
            index: dataArray.length,
            value: '',
        }
        setAttributes({ 
            dataArray: [...dataArray, attr]
        });
    }

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
			dataArray,
        } = attributes;

        const imageArray = dataArray?.map((data, index) => {
            return(
                <Fragment>
                    <div className='row'>
                        <div className='image'>
                            {!data.value &&
                                <MediaUploadCheck>
                                    <MediaUpload
                                        onSelect={ ( media ) => {
                                            let arrayCopy = [...dataArray];
                                            arrayCopy[index].value = media.url;
                                            setAttributes({ dataArray: arrayCopy });
                                        }}
                                        value={ data.value }
                                        render={ ( { open } ) => (
                                            <Button onClick={ open } className="naomi-mediaupload" style={{right: "27px"}}>Add Image</Button>
                                        ) }
                                    />
                                </MediaUploadCheck>
                            }
                            {data.value &&
                                <MediaUploadCheck>
                                    <MediaUpload
                                        onSelect={ ( media ) => {
                                            let arrayCopy = [...dataArray];
                                            arrayCopy[index].value = media.url;
                                            setAttributes({ dataArray: arrayCopy });
                                        }}
                                        value={ data.value }
                                        render={ ( { open } ) => (
                                            <Button onClick={ open } className="naomi-mediaupload replace">Replace Image</Button>
                                        ) }
                                    />
                                </MediaUploadCheck>
                            }
                            <img src={data.value}></img>
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
                    </div>
                </Fragment>
            )
        });

        return (
            <Fragment>
                <InspectorControls>
                </InspectorControls>
                <div className="gallery-block naomimoon-portfolio__gallery align-center">
                    <h1>Gallery Block</h1>
                    {imageArray}
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
            </Fragment>
        );
    }
}