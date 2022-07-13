/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { Component } from '@wordpress/element';
import { RichText } from '@wordpress/block-editor';

/**
 * Export component
 */
export default class heroSave extends Component {

	render() {
		const { attributes, className } = this.props;
        const {
            heading,
            subHeading,
            description
        } = attributes;

        return (
            <div className="hero-block naomimoon-homepage__hero align-center" id="home">
                <div className="overlay-wrapper"></div>
                <div className="hero-card">
                    <RichText.Content
                        tagName="h1"
                        value={ heading }
                    />
                    <span className="naomimoon-border-bottom"></span>
                    <RichText.Content
                        tagName="h3"
                        value={ subHeading }
                    />
                    <RichText.Content
                        tagName="h4"
                        value={ description }
                    />
                </div>
            </div>
        );
	}
}
