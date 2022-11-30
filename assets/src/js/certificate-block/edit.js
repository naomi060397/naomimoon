/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { Component, Fragment } from '@wordpress/element';
import { PanelBody, Button, ToggleControl, TextareaControl, Tooltip } from '@wordpress/components';
import { InspectorControls, RichText, MediaUpload, MediaUploadCheck } from '@wordpress/block-editor';

/**
 * Export component
 */
export default class certificatetEdit extends Component {

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
                value: ''
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
            value: ''
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
            dataArray
        } = attributes;

        const certListing = dataArray?.map((data, index) => {
            return(
                <Fragment>
                    <div className="col">
                        <RichText
                            tagName="p"
                            value={data.value}
                            placeholder={__( "Enter Certificate Description..." )}
                            onChange={value => {
                            let arrayCopy = [...dataArray];
                            arrayCopy[index].value = value;
                            setAttributes({ dataArray: arrayCopy });
                            }}
                        />
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
					<PanelBody title={__("Settings")} initialOpen={true}>
						<ToggleControl
							label={__( "Toggle Heading" )}
							checked={toggleHeading}
							onChange={toggleHeading=>setAttributes({toggleHeading})}
						/>
					</PanelBody>
                </InspectorControls>
				<div className='certificate-block' id="certificates">
                    <div className='container'>
                    {toggleHeading && 
                        <div className="certificate-heading">
                            <RichText
                                tagName="h2"
                                value={ heading }
                                onChange={ ( heading ) => setAttributes( { heading } ) }
                                placeholder={ __( 'Heading...' ) }
                                className="portfolio-heading"
                            />
                            <span className='naomimoon-border-bottom'></span>
                        </div>
                    }
                        <div className="row">
                            {certListing}
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
				</div>
            </Fragment>
        );
    }
}