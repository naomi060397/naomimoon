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
            avatar,
            toggleAvatar,
            heading,
            subHeading,
            toggleHeading,
            toggleSubheading,
            dataArray,
            itemPadding,
            itemGap,
        } = attributes;

        const itemStyles = {};
        itemPadding && (itemStyles.padding = itemPadding + "px 27px");

        const itemContainerStyles = {};
        itemGap && (itemContainerStyles.gap = itemGap + "px");

        return (
            <div className='link-block' id="links">
                <div className='container'>
                    <div className='link-card'>
                        {toggleAvatar &&
                            <div className="link-avatar">
                                <img src={avatar}></img>
                            </div>
                        }
                        {toggleHeading &&
                        <div className="link-heading">
                            <RichText.Content
                                tagName="h2"
                                value={ heading }
                            />
                        </div>
                        }
                        {toggleSubheading &&
                        <div className="link-subheading">
                            <RichText.Content
                                tagName="h4"
                                value={ subHeading }
                            />
                        </div>
                        }
                        <div className="row" style={itemContainerStyles}>
                        {dataArray.map((data) => {
                            return(
                                <div className="col">
                                    <RichText.Content
                                        tagName="p"
                                        value={data.value}
                                        style={itemStyles}
                                    />
                                    <div className="image">
                                        <img class="link-item-icon" src={data.icon}></img>
                                    </div>
                                </div>
                            ) 
                        })}
                        </div>
                    </div>
                    <div className="link-footer">
                        <i>Created with <a href="https://wordpress.org/">WordPress</a></i>
                        <span> | </span>
                        <i>Color scheme by <a href="https://github.com/dracula/dracula-theme">Dracula</a></i>
                    </div>
                </div>
            </div>
        );
	}
}
