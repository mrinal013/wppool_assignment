import { __ } from '@wordpress/i18n';
import { compose } from '@wordpress/compose';
import { withSelect, withDispatch } from '@wordpress/data';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { PanelRow, TextControl } from '@wordpress/components';

const MetaBox = ( { postType, metaFields, setMetaFields } ) => {

	if ( 'projects' !== postType ) return null;

	return(
		<PluginDocumentSettingPanel 
			title={ __( 'Project URL' ) } 
			icon="admin-links"
			initialOpen={ false }
		>
			<PanelRow>
				<TextControl 
					value={ metaFields._project_external_url }
					label={ __( "URL" ) }
					onChange={ (value) => setMetaFields( { _project_external_url: value } ) }
				/>
			</PanelRow>
		</PluginDocumentSettingPanel>
	);
}

const applyWithSelect = withSelect( ( select ) => {
	return {
		metaFields: select( 'core/editor' ).getEditedPostAttribute( 'meta' ),
		postType: select( 'core/editor' ).getCurrentPostType()
	};
} );

const applyWithDispatch = withDispatch( ( dispatch ) => {
	return {
		setMetaFields ( newValue ) {
			dispatch('core/editor').editPost( { meta: newValue } )
		}
	}
} );

export default compose([
	applyWithSelect,
	applyWithDispatch
])(MetaBox);