(function( blocks, components, element ) {
  var el = element.createElement;
  var registerBlockType = blocks.registerBlockType;

  registerBlockType( 'rx-petroip/testimonials', {
    title: 'RX Testimonials',
    icon: 'awards',
    category: 'common',
    attributes: {
      numberOfItems: {
        type: 'number',
        default: 0
      },
      alignment: {
        type: 'string',
        default: 'none'
      }
    },
    edit: function(props) {
      var attributes = props.attributes;
      var setAttributes = props.setAttributes;
      const { name } = props;
      const { title, icon } = wp.blocks.getBlockType(name);
    
      function onChangeNumberOfItems(value) {
        setAttributes({ numberOfItems: Number(value) });
      }

      return [
        el('div', { className: props.className + ' components-placeholder' },
          el(
            'span',
            { className: 'components-placeholder__label' },
            el('i', { className: 'dashicon dashicons dashicons-' + icon.src }),
            title
          ),
          el('div', { className: 'rx-block-field' },
            el(components.TextControl, {
              label: 'Number of items',
              type: 'number',
              value: attributes.numberOfItems,
              help: 'Set to 0 for all items',
              onChange: onChangeNumberOfItems,
            }),
          ),
        ),
      ];
    },
    save: () => {
      return null;
    }
  } );
}(
  window.wp.blocks,
  window.wp.components,
  window.wp.element
));