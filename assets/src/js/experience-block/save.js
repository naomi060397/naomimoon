/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { Component } from '@wordpress/element';
import { RichText } from '@wordpress/block-editor';

/**
 * Export component
 */
export default class experienceSave extends Component {
	render() {
		const { attributes, className } = this.props;
        const {
            heading,
            toggleHeading,
            dataArray,
        } = attributes;

        return (
            <div className='experience-block t-break b-break' id="experience">
                <div className='container'>
                {toggleHeading && 
                    <div className="experience-heading">
                        <RichText.Content
                            tagName="h2"
                            value={ heading }
                            className="portfolio-heading mb-30"
                        />
                        <span className='naomimoon-border-bottom'></span>
                    </div>
                }
                    <div className="row">
                        {dataArray.map((data) => {
                            return(
                                <div className="col">
                                    <RichText.Content
                                        tagName="h3"
                                        value={data.title}
                                    />
                                    <div className='experience-list'>
                                        <RichText.Content
                                            tagName="p"
                                            value={data.list}
                                        />
                                    </div>
                                </div>
                            )
                        })}
                    </div>
                </div>
            </div>
        );
	}
}
