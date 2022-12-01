/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { Component, Fragment } from '@wordpress/element';
import { RichText } from '@wordpress/block-editor';

/**
 * Export component
 */
export default class linkSave extends Component {
	render() {
		const { attributes, className } = this.props;
        const {
            heading,
            subHeading,
            toggleHeading,
            dataArray,
        } = attributes;

        return (
            <div className='link-block' id="links">
                <div className='container'>
                    <div className='link-card'>
                        {toggleHeading &&
                        <div className="link-heading">
                            <RichText.Content
                                tagName="h2"
                                value={ heading }
                            />
                        </div>
                        }
                        <div className="row">
                        {dataArray.map((data) => {
                            return(
                                <div className="col">
                                    <RichText.Content
                                        tagName="p"
                                        value={data.value}
                                    />
                                    <div className="image">
                                        <img class="link-item-icon" src={data.icon}></img>
                                    </div>
                                </div>
                            ) 
                        })}
                        </div>
                    </div>
                </div>
            </div>
        );
	}
}
