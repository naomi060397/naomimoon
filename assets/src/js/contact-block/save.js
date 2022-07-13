/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { Component } from '@wordpress/element';
import { RichText } from '@wordpress/block-editor';

/**
 * Export component
 */
export default class contactSave extends Component {

	render() {
		const { attributes, className } = this.props;
        const {
            heading,
            toggleHeading,
            dataArray,
            flexWidth
        } = attributes;

        const flexStyle = {};
        flexWidth && (flexStyle.flex = '0 0 ' + flexWidth + '%');

        return (
            <div className='contact-block container' id="contact">
            {toggleHeading &&
                <div>
                    <RichText.Content
                        tagName="h2"
                        value={ heading }
                        className="home-heading"
                    />
                    <span className="naomimoon-border-bottom"></span>
                </div>
            }
                <div className="row contact-row">
                {0 < dataArray.length && (
                    dataArray.map((data, index) => {
                        return(
                            <div className="col" style={flexStyle}>
                                <a href={dataArray[index].url}>
                                    <img
                                        src={dataArray[index].icon}
                                        alt={dataArray[index].iconAlt}
                                        loading="lazy"
                                        height="40px"
                                        width="40px"
                                    />
                                </a>
                                <a href={dataArray[index].url}>
                                    <RichText.Content
                                        tagName="h4"
                                        value={data.title}
                                        className="contact-title"
                                    />
                                </a>
                            </div>
                        )
                    })
                )}
                </div>
			</div>
        );
	}
}
