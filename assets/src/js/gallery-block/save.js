/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { Component } from '@wordpress/element';
import { RichText } from '@wordpress/block-editor';

/**
 * Export component
 */
export default class gallerySave extends Component {

	render() {
		const { attributes, className } = this.props;
        const {
            dataArray,
        } = attributes;

        return (
            <div className="gallery-block naomimoon-portfolio__gallery align-center">
                <h1>Gallery Block</h1>
                <div className="row">
                    <div className="image">
                    {dataArray.map((data) => {
                        return(
                            <img src={data.value}></img>
                        ) 
                    })}
                    </div>
                </div>
            </div>
        );
	}
}
