/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { Component } from '@wordpress/element';
import { RichText } from '@wordpress/block-editor';

/**
 * Export component
 */
export default class projectSave extends Component {
	render() {
		const { attributes, className } = this.props;
        const {
            heading,
            toggleHeading,
            mediaId,
            descHeading,
            desc,
            layout,
            projectUrl
        } = attributes;

        const leftBorderRad = {borderTopLeftRadius: '10px', borderBottomLeftRadius: '10px'};
        const rightBorderRad = {borderTopRightRadius: '10px', borderBottomRightRadius: '10px'};
        const textAlignRight = {textAlign: 'right'};
        const flexStyle = {};
        layout && (flexStyle.flexDirection = layout);

        return (
            <div className='project-block container' id="projects">
            {toggleHeading &&
                <RichText.Content
                    tagName="h2"
                    value={ heading }
                    className="home-heading"
                />
            }
                <div className="row" style={flexStyle}>
                    <div className='col image' style={layout === 'row' ? leftBorderRad : rightBorderRad}>
                        <a href={projectUrl}><img src={mediaId}></img></a>
                    </div>
                    <div className='col content' style={layout === 'row' ? rightBorderRad : leftBorderRad}>
                        <a href={projectUrl} style={layout !== 'row' ? textAlignRight : ''}>
                            <RichText.Content
                                tagName="h4"
                                value={ descHeading }
                                className="desc-heading"
                            />
                        </a>

                        <RichText.Content
                            tagName="p"
                            value={ desc }
                            className="desc"
                            style={layout !== 'row' ? textAlignRight : ''}
                        />
                    </div>
                </div>
			</div>
        );
	}
}
