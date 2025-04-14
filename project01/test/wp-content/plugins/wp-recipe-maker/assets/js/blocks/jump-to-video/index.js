const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

// Backwards compatibility.
let RichText;
if ( wp.hasOwnProperty( 'blockEditor' ) ) {
	RichText = wp.blockEditor.RichText;
} else {
	RichText = wp.editor.RichText;
}

import '../../../css/public/snippets.scss';

registerBlockType( 'wp-recipe-maker/jump-to-video', {
    title: __( 'Jump to Video', 'wp-recipe-maker' ),
    description: __( 'A button to jump to a WPRM Recipe Video on the same page.', 'wp-recipe-maker' ),
    icon: 'button',
    keywords: [ 'wprm' ],
    example: {
		attributes: {
            id: -1,
		},
	},
    category: 'wp-recipe-maker',
    supports: {
		html: false,
    },
    transforms: {
        from: [
            {
                type: 'shortcode',
                tag: 'wprm-recipe-jump-video',
                attributes: {
                    id: {
                        type: 'number',
                        shortcode: ( { named: { id = '' } } ) => {
                            return parseInt( id.replace( 'id', '' ) );
                        },
                    },
                    text: {
                        type: 'string',
                        shortcode: ( { named: { text = '' } } ) => {
                            return text.replace( 'text', '' );
                        },
                    },
                },
            },
        ]
    },
    edit: (props) => {
        const { attributes, setAttributes, isSelected, className } = props;
        const { text } = attributes;

        const richToString = ( text ) => {
            setAttributes( {
                text: text[0],
            } );
        }

        return (
            <div className={ className }>
                <RichText
                    tagName="a"
                    placeholder="Link Text"
                    value={ [text] }
                    onChange={ ( nextValue ) => richToString( nextValue ) }
                    multiline={ false }
                    allowedFormats={ [] }
                />
            </div>
        )
    },
    save: (props) => {
        return null;
    },
} );