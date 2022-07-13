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
        } = attributes;

        return (
            <div className='hero-block container' id="home">
                hello
			</div>
        );
	}
}
