/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { Component } from '@wordpress/element';
import { RichText } from '@wordpress/block-editor';

/**
 * Export component
 */
export default class aboutSave extends Component {

	render() {
		const { attributes, className } = this.props;
        const {
            heading,
            content
        } = attributes;

        return (
            <div className="about-block naomimoon-portfolio__about container" id="about">
                <div className="square-border">
                    <RichText.Content
                        tagName="h1"
                        value={ heading }
                        className="portfolio-heading mb-10"
                    />
                    <span class="naomimoon-border-bottom"></span>
                    <RichText.Content
                        tagName="p"
                        value={ content }
                        className="pb-40 pt-25"
                    />
                </div>
            </div>
        );
	}
}
