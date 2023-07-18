(function( blocks, components, element, ) {
  var el = element.createElement;
  var registerBlockType = blocks.registerBlockType;

  registerBlockType( 'rx-petroip/products', {
    title: 'RX Products',
    icon: 'archive',
    category: 'common',
    attributes: {
      layout: {
        type: 'string',
        default: 'normal'
      },
      numberOfItems: {
        type: 'number',
        default: 0
      },
      numberOfColumns: {
        type: 'number',
        default: 4
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
    
      function onChangeLayout(value) {
        setAttributes({ layout: value });
      }
    
      function onChangeNumberOfItems(value) {
        setAttributes({ numberOfItems: Number(value) });
      }
    
      function onChangeNumberOfColumns(value) {
        setAttributes({ numberOfColumns: Number(value) });
      }
    
      var layoutOptions = [
        { value: 'normal', label: 'Normal' },
        { value: 'masonry', label: 'Masonry' },
      ];
    
      return [
        el('div', { className: props.className + ' components-placeholder' },
          el(
            'span',
            { className: 'components-placeholder__label' },
            el('i', { className: 'dashicon dashicons dashicons-' + icon.src }),
            title
          ),
          el('div', { className: 'rx-block-field' },
            el(components.SelectControl, {
              label: 'Layout',
              value: attributes.layout,
              options: layoutOptions,
              onChange: onChangeLayout,
            }),
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
          el('div', { className: 'rx-block-field' },
            el(components.TextControl, {
              label: 'Number of columns',
              type: 'number',
              value: attributes.numberOfColumns,
              onChange: onChangeNumberOfColumns,
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