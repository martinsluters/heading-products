import { __ } from '@wordpress/i18n';

import {
	useBlockProps,
	BlockControls,
	HeadingLevelDropdown,
	AlignmentControl,
} from '@wordpress/block-editor';

import {
	__experimentalInputControl as InputControl, // eslint-disable-line @wordpress/no-unsafe-wp-apis
	ToolbarGroup,
	ToolbarButton,
	Button,
	BaseControl,
} from '@wordpress/components';

import { useState, useEffect } from '@wordpress/element';

import ServerSideRender from '@wordpress/server-side-render';

import './editor.scss';

export default function Edit( { attributes, setAttributes, clientId } ) {
	const {
		heading,
		blockIdentifier,
		headingTagLevel,
		order,
		orderby,
		textAlign,
	} = attributes;
	const uniqueBlockIdentifiers = [];
	const [ isEditing, setIsEditing ] = useState( false );
	const [ tempHeading, setTempHeading ] = useState( heading );

	useEffect( () => {
		if (
			null === blockIdentifier ||
			'' === blockIdentifier ||
			uniqueBlockIdentifiers.includes( blockIdentifier )
		) {
			const newBlockIdentifier =
				'heading-products-' +
				clientId.substring( 2, 9 ).replace( '-', '' );
			setAttributes( { blockIdentifier: newBlockIdentifier } );
			uniqueBlockIdentifiers.push( newBlockIdentifier );
		} else {
			uniqueBlockIdentifiers.push( blockIdentifier );
		}
	} );

	return (
		<div { ...useBlockProps() }>
			<BlockControls group="block">
				<HeadingLevelDropdown
					value={ headingTagLevel }
					onChange={ ( newLevel ) => {
						setAttributes( { headingTagLevel: newLevel } );
					} }
				/>
				<AlignmentControl
					value={ textAlign }
					onChange={ ( nextAlign ) => {
						setAttributes( { textAlign: nextAlign } );
					} }
				/>
				<ToolbarGroup>
					<ToolbarButton
						icon="edit"
						label={ __( 'Edit Heading', 'heading-products' ) }
						onClick={ () => {
							setTempHeading( heading );
							setIsEditing( true );
						} }
					/>
				</ToolbarGroup>
			</BlockControls>

			{ isEditing ? (
				<div
					className={
						'wp-block-challenges-heading-products__edit-view'
					}
				>
					<BaseControl help="Since a 'custom field' term was used in challenge description which is a vageue term, I chose to use an actual input field. Otherwise, I would have used a RichText component without this extra edit view.">
						<InputControl
							label={ __( 'Block Heading:', 'heading-products' ) }
							labelPosition="top"
							value={ tempHeading }
							type="text"
							isPressEnterToChange={ true }
							onChange={ ( newValue ) =>
								setTempHeading( newValue )
							}
						/>

						<Button
							className={
								'wp-block-challenges-heading-products__edit-control-button'
							}
							variant="primary"
							onClick={ () => {
								setAttributes( { heading: tempHeading } );
								setIsEditing( false );
							} }
						>
							{ __( 'Save', 'custom-product-block' ) }
						</Button>

						<Button
							className={
								'wp-block-challenges-heading-products__edit-control-button'
							}
							variant="tertiary"
							onClick={ () => {
								setIsEditing( false );
							} }
							style={ { marginLeft: '8px' } }
						>
							{ __( 'Cancel', 'heading-products' ) }
						</Button>
					</BaseControl>
				</div>
			) : (
				<ServerSideRender
					block="challenge/heading-products"
					attributes={ {
						heading,
						blockIdentifier: blockIdentifier
							? blockIdentifier
							: 'temp-identifier',
						order,
						orderby,
						headingTagLevel,
						textAlign,
					} }
				/>
			) }
		</div>
	);
}
