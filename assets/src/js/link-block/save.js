/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { Component } from '@wordpress/element';
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
                    {toggleHeading &&
                    <div className="link-heading">
                        <RichText.Content
                            tagName="h2"
                            value={ heading }
                        />
                        <span className='naomimoon-border-bottom'></span>
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
                            </div>
                        ) 
                    })}
                    </div>
                </div>
            </div>
        );
	}
}
